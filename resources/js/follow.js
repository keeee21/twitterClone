'use strict';

const { stringify } = require("postcss");

$(function (){

  $('.follow').on('click', function(){

    const classFollow = $(this);
    let followUserId = classFollow.data('user-id');

    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/users/follow/'+followUserId, 
      type: 'POST', //HTTPメソッドの種別を指定
      cache:false,
      dataType:'html',
      data: { //サーバーに送信するデータ
        user_id: followUserId //フォローボタン押されたUserのidを送る
      },
    })
    //通信成功した時の処理
    .done(function (data) {
      const responseJSON = JSON.parse(data);
      console.log(responseJSON.status);
      classFollow.toggleClass("pushedFollow");
      $('.pushedFollow').text('フォロー解除');
      classFollow.toggleClass("pushedUnFollow");
      $('.pushedUnFollow').text('フォロー');
    })
    //通信失敗した時の処理
    .fail(function (error) {
      console.log(error); 
    });
  });
});
