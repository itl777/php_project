
const avatar_upload = document.avatarForm.avatar_upload;
avatar_upload.onchange = (event) => {
  avatar_img.classList.replace('opacity-100', 'opacity-0');
  let fd = new FormData(document.avatarForm);
  setTimeout(function () {
    fetch("api/avatar_upload_api.php", {
      method: "POST",
      body: fd,
    })
      .then((r) => r.json())
      .then((result) => {
        if (result.success) {
          // result.filename
          avatar.value = result.filename;
          avatar_img.src = `images/${result.filename}`;
          setTimeout(function () {
            avatar_img.classList.replace('opacity-0', 'opacity-100');
          }, 500);
        }

      })
      .catch((ex) => console.log(ex));
  }, 500);
};