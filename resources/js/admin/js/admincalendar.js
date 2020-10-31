$('#modalForm').on('show.bs.modal', function (event) {
    //モーダルを開いたボタンを取得
    var button = $(event.relatedTarget);
    //モーダル自身を取得
    var modal = $(this);
    //data-cusnoの値取得
    var kokyuVal = button.data('kokyu');
    // input 欄に値セット
    modal.find('.modal-body input#kokyu').val(kokyuVal);
    
});