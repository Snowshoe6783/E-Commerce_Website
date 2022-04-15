const el = document.getElementById('select');

const box = document.getElementById('box');

el.addEventListener('change', function handleChange(event) {
  if (event.target.value === 'show') {
    box.style.display = 'block';
  } else {
    box.style.display = 'none';
  }
});