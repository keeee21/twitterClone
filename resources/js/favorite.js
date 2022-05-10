'use strict';

$(function (){

  $('.favorite').on('click', function(){

    const classFavorite = $(this);
    let favoriteTweetId = classFavorite.data('tweet-id');

    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/users/favorite/'+favoriteTweetId, 
      type: 'POST', //HTTPメソッドの種別を指定
      cache:false,
      dataType:'html',
      data: { //サーバーに送信するデータ
        tweet_id: favoriteTweetId //いいねされた投稿のtweet-idを送る
      },
    })
    //通信成功した時の処理
    .done(function (data) {
      const responseJSON = JSON.parse(data);
      console.log(responseJSON.status);
      classFavorite.toggleClass("pushedFavorite");
      classFavorite.toggleClass("btn");
    })
    //通信失敗した時の処理
    .fail(function (error) {
      console.log(error); 
    });
  });
});
