const clearForm = function (formId) {
  let form = document.getElementById(formId);
  let inputs = form.querySelectorAll('input');
  let spans = form.querySelectorAll('span');
  let textareas = form.querySelectorAll('textarea');
  let selects = form.querySelectorAll('select');
  let imgs = form.querySelectorAll('select');

  inputs.forEach(input => {
    if (input.type !== 'radio') {
      input.value = '';
    }
  });
  textareas.forEach(textarea => {
    textarea.value = '';
  });
  selects.forEach(select => {
    select.innerHTML = '';
  });
  spans.forEach(span => {
    span.innerHTML = '';
  });
  imgs.forEach(img => {
    img.src = '';
  });
};
