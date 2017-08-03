/*Toast Init*/


$(document).ready(function() {
    "use strict";
    
    $.toast({
        text: "Don't forget to star the repository if you like it.", // Text that is to be shown in the toast
        heading: 'Welcome', // Optional heading to be shown on the toast
        icon: 'success', // Type of toast icon
        showHideTransition: 'plain', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        
        
        
        textAlign: 'left',  // Text alignment i.e. left, right or center
        loader: true,  // Whether to show loader or not. True by default
        loaderBg: '#ff8000',  // Background color of the toast loader
        beforeShow: function () {}, // will be triggered before the toast is shown
        afterShown: function () {}, // will be triggered after the toat has been shown
        beforeHide: function () {}, // will be triggered before the toast gets hidden
        afterHidden: function () {}  // will be triggered after the toast has been hidden
    });
    
    $('.tst1').on('click',function(e){
        $.toast().reset('all'); 
        $("body").removeAttr('class');
        $.toast({
            heading: '2 new messages',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg:'#fec107',
            icon: 'info',
            hideAfter: 3000, 
            stack: 6
        });
        return false;
    });

    $('.tst2').on('click',function(e){
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            heading: 'Server not responding',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg:'#ff2a00',
            icon: 'warning',
            hideAfter: 3500, 
            stack: 6
        });
        return false;
    });
    
    $('.tst3').on('click',function(e){
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            heading: 'Welcome to Hound',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg:'#fec107',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
        return false;  
    });

    $('.tst4').on('click',function(e){
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            heading: 'Opps! somthing wents wrong',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg:'#fec107',
            icon: 'error',
            hideAfter: 3500
        });
        return false;
    });
    
    $('.tst5').on('click',function(e){
        $.toast().reset('all');   
        $("body").removeAttr('class');
        $.toast({
            heading: 'Top Left',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-left',
            loaderBg:'#878787',
            hideAfter: 3500
        });
        return false;
    });
    
    $('.tst6').on('click',function(e){
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            heading: 'Top Right',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg:'#878787',
            hideAfter: 3500
        });
        return false;
    });
    
    $('.tst7').on('click',function(e){
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            heading: 'Bottom Left',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'bottom-left',
            loaderBg:'#878787',
            hideAfter: 3500
        });
        return false;
    });
    
    $('.tst8').on('click',function(e){
        $.toast().reset('all');   
        $("body").removeAttr('class');
        $.toast({
            heading: 'Bottom Right',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'bottom-right',
            loaderBg:'#878787',
            hideAfter: 3500
        });
        return false;
    });
    
    $('.tst9').on('click',function(e){
        $.toast().reset('all');   
        $("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
        $.toast({
            heading: 'Top Center',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-center',
            loaderBg:'#878787',
            hideAfter: 3500
        });
        return false;
    });
    
    $('.tst10').on('click',function(e){
        $.toast().reset('all');
        $("body").removeAttr('class').addClass("bottom-center-fullwidth");
        $.toast({
            heading: 'Bottom Right',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'bottom-center',
            loaderBg:'#878787',
            hideAfter: 3500
        });
        return false;
    });
});
          
