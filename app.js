document.querySelectorAll('form[data-check]').forEach(function (form) {
  const button = form.querySelector('button[type="submit"]');
  const password = form.querySelector('input[name="password"]');
  const confirm = form.querySelector('input[name="confirm"]');

  function update() {
    let ok = form.checkValidity();
    if (ok && password && confirm) {
      ok = password.value === confirm.value;
    }
    button.disabled = !ok;
  }

  form.addEventListener('input', update);
  form.addEventListener('change', update);
  form.addEventListener('keyup', update);
  window.addEventListener('load', update);
  setTimeout(update, 300);
  setTimeout(update, 1000);
  update();
});

document.querySelectorAll('button[data-toggle]').forEach(function (toggle) {
  const target = document.getElementById(toggle.dataset.toggle);

  toggle.addEventListener('mousedown', function (event) {
    event.preventDefault();
  });

  toggle.addEventListener('click', function () {
    if (!target) {
      return;
    }
    const reveal = target.type === 'password';
    target.type = reveal ? 'text' : 'password';
    toggle.classList.toggle('on', reveal);
    toggle.setAttribute('aria-label', reveal ? 'Hide password' : 'Show password');
  });
});
