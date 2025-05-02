const cursor = document.querySelector('.cursor');
const trail = document.querySelector('.cursor-trail');

document.addEventListener('mousemove', e => {
  const x = e.clientX;
  const y = e.clientY;

  // Gerakkan kursor utama
  cursor.style.transform = `translate(${x}px, ${y}px)`;

  // Gerakkan jejak kursor dengan sedikit delay
  trail.style.transform = `translate(${x}px, ${y}px)`;
});

document.addEventListener('mousedown', () => {
  cursor.style.transform += ' scale(1.5)';
});

document.addEventListener('mouseup', () => {
  cursor.style.transform = cursor.style.transform.replace(' scale(1.5)', '');
});
