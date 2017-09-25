<?php

use Illuminate\Database\Seeder;

use App\Document;
use App\User;
use App\Folder;
use App\Organization;


class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->delete();
        //DB::table('users')->delete();
        //DB::table('folders')->delete();
        //DB::table('organizations')->delete();
        /*$json = File::get("database/data/incomming-documents.json");
        $iDocuments = json_decode($json);*/
        $json = File::get("database/datas/documents.json");
        $oDocuments = json_decode(trim($json));
        /*$json = File::get("database/data/folders.json");
        $folders = json_decode($json);
        $json = File::get("database/data/organizations.json");
        $organizations = json_decode($json);*/

        /*Incomming Documents*/
        /*foreach ($iDocuments as $document) {
          //Get Document User
          $user = User::where('name',$document->name);
          //Create Document User if doesn't exist
          if(!$user){
            $user = User::create([
              'username' => strtolower($document->name),
              'name' => $document->name;
              'email' => strtolower($document->name).'@lefkearchive.com',
              'password' => bcrypt('123456')
              'role' => 'user'
            ])
          }

          //Get Document Folder
          $folder = Folder::where('ref', $document->ref)->first();

          //Create Document Folder if doesn't exist
          if(!$folder){
            $folder = Folder::create([
              'ref' => $document->ref,
              'name' => $document->name
            ])
          }

          //Get Document Organization
          $organization = Organization::where('name', $document->name)->first();

          //Create Document Organization if doesn't exist
          if(!$organization){
            $organization = Organization::create([
              'name' => $document->organization
            ])
          }
          Document::create([
            'ref' => $document->ref,
            'title' => $document->title,
            'type' => 'incomming',
            'written_on' => Carbon::createFromFormat('Y-m-d', $document->written_on)->toDateTimeString(),
            'signed_on' => Carbon::createFromFormat('Y-m-d', $document->signed_on)->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'user_id' => $user->id,
            'folder_id' => $folder->id,
            'organization_id' => $organization->id,

          ])
        }*/

        /*Outgoing Documents*/
        //dd($oDocuments);
        foreach ($oDocuments as $document) {
          //Get Document User
          $user = User::where('username',strtolower($document->user))->first();
          //Create Document User if doesn't exist
          if(!$user){
            $user = User::create([
              'username' => strtolower($document->user),
              'name' => $document->user,
              'email' => strtolower($document->user).'@lefkearchive.com',
              'password' => bcrypt('123456'),
              'role' => 'user'
            ]);
          }

          //Get Document Folder
          $folder = Folder::where('ref', $document->folderRef)->first();

          //Create Document Folder if doesn't exist
          if(!$folder){
            $folder = Folder::create([
              'ref' => $document->folderRef,
              'name' => $document->folder
            ]);
          }

          //Get Document Organization
          $organization = Organization::where('name', 'Lefke Belediyesi')->first();

          //Create Document Organization if doesn't exist
          if(!$organization){
            $organization = Organization::create([
              'name' => 'Lefke Belediyesi'
            ]);
          }

    

          Document::create([
            'ref' => $document->ref,
            'title' => $document->title,
            'type' => 'outgoing',
            'written_on' => $document->written_on,
            'signed_on' => $document->signed_on,
            'user_id' => $user->id,
            'folder_id' => $folder->id,
            'organization_id' => $organization->id

          ]);
        }
    }
}
