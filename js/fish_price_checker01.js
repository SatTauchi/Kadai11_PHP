// 1.Saveクリックイベント
function saveData() {
  const dateValue = $("#date").val();
  const fishValue = $("#fish").val();
  const placeValue = $("#place").val();
  const priceValue = $("#price").val();
  const remarksValue = $("#remarks").val();
  const fileInput = document.getElementById("imgFile");

  if (fileInput.files.length === 0) {
      alert("画像ファイルを選択してください。");
      return;
  }
}

// Saveクリック後に入力内容をクリアする
function clearForm() {
    $("#date").val("");
    $("#fish").val("");
    $("#place").val("");
    $("#price").val("");
    $("#remarks").val("");
    $("#imgFile").val("");
    $(".preview").css("background-image", "none"); // プレビュー画像をクリア
    window.myLine.destroy();// グラフエリアをクリア
}

// ファイル選択欄の変更イベントに関数を結び付けて、プレビュー表示を行う
$('#imgFile').change(
  function () {
      if (!this.files.length) {
          return;
      }

      var file = $(this).prop('files')[0];
      var fr = new FileReader();
      $('.preview').css('background-image', 'none');
      fr.onload = function() {
          $('.preview').css('background-image', 'url(' + fr.result + ')');
      }
      fr.readAsDataURL(file);
  }
);

//2.クリアをクリックした際に入力内容をリセットする
$("#empty").on("click", function () {
  $("#date").val("");
  $("#fish").val(""); 
  $("#place").val("");
  $("#price").val(""); 
  $("#remarks").val(""); 
  $("#imgFile").val("");
  $(".preview").css("background-image", "none"); 
  $("#list").empty();
  window.myLine.destroy();// グラフエリアをクリア 
});

// data_input.php、data_update.phpの備考欄における入力文字数制限　200文字を超えた場合にエラーメッセージ表示
document.getElementById('remarks').addEventListener('input', function() {
  var remarks = document.getElementById('remarks');
  var charCount = document.getElementById('charCount');
  var errorMessage = document.getElementById('error-message');
  
  charCount.textContent = remarks.value.length + "/200";
  
  if (remarks.value.length > 200) {
    errorMessage.style.display = 'block';
    document.querySelector('.btn').disabled = true;
  } else {
    errorMessage.style.display = 'none';
    document.querySelector('.btn').disabled = false;
  }
})





// document.getElementById('fishPriceForm').addEventListener('submit', function(e) {
//   e.preventDefault();
//   // ここでフォームデータの送信処理を行う
//   // 成功後、以下のトースト表示とフォームリセットを行う
//   document.getElementById('toast').classList.add('show');
//   setTimeout(() => {
//     document.getElementById('toast').classList.remove('show');
//   }, 3000);
//   this.reset();
// });

// document.querySelector('.file-input-wrapper input[type=file]').addEventListener('change', function() {
//   if (this.files && this.files[0]) {
//     var fileName = this.files[0].name;
//     this.parentElement.querySelector('.btn').textContent = fileName;
//   }
// });

