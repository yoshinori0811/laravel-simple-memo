function deleteHandle(event){
  // 一旦formを止める
  event.preventDefault();
  if(window.confirm('本当に削除していいですか？')){
    // 削除するならformを再開
    document.getElementById('delete-form').submit();
  }else{
    alert('キャンセルしました！');
  }
}
