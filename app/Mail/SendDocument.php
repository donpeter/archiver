<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class SendDocument extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $document;
    private $request;
    public function __construct($document, $request)
    {
        $this->document = $document;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.document.send')
            ->subject($this->request->subject)
            ->attachAll($this->document->files)
            ->with(['document' =>$this->document, 'emailMessage' => $this->request->message]);


    }

    /**
     * Attach a file to the message.
     *
     * @param  string  $file
     * @param  array  $options
     * @return $this
     */
    public function attachAll($files, array $options = [])
    {
        foreach ($files as $file) {
            $fileData = Storage::get($file->slug);
            //dd($file);
            $ext = substr($file->type, strripos($file->type,'/')+1);
            //dd($ext);
            $this->attachData($fileData, "{$file->name}.{$ext}", [
                        'mime' => $file->type,
                    ]);
            //$this->attach('./../../public/upload/'.$file->slug);
        }
        return $this;
    }
}
