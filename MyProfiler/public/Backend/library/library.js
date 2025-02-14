(function($){
    "use strict";
    var HT = {};
    var documentObj = $(document);

    HT.switchery = function() {
        $('.js-switch').each(function(){
            new Switchery(this, {color:'#1AB394'});
        });
    };

    documentObj.ready(function(){
        HT.switchery();
    });
})(jQuery);
