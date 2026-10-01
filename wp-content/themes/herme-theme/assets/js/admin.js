(() => {
  const add = document.getElementById('herme-add-images');
  const input = document.getElementById('herme-gallery-ids');
  const preview = document.getElementById('herme-gallery-preview');
  if (!add || !input || !preview || !window.wp?.media) return;

  const ids = () => input.value.split(',').filter(Boolean);
  const sync = () => { input.value = [...preview.querySelectorAll('[data-id]')].map(item => item.dataset.id).join(','); };

  add.addEventListener('click', () => {
    const frame = wp.media({ title: 'Galeria do produto', button: { text: 'Adicionar imagens' }, multiple: true, library: { type: 'image' } });
    frame.on('select', () => {
      frame.state().get('selection').each(attachment => {
        const image = attachment.toJSON();
        if (ids().includes(String(image.id))) return;
        const item = document.createElement('div');
        item.dataset.id = String(image.id);
        item.style.cssText = 'position:relative';
        const img = document.createElement('img');
        img.src = image.sizes?.thumbnail?.url || image.url;
        img.alt = image.alt || '';
        img.width = 120;
        img.height = 120;
        img.style.objectFit = 'cover';
        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'button-link herme-remove-image';
        remove.textContent = 'Remover';
        remove.setAttribute('aria-label', 'Remover imagem');
        remove.style.display = 'block';
        item.append(img, remove);
        preview.append(item);
        sync();
      });
    });
    frame.open();
  });

  preview.addEventListener('click', event => {
    if (!event.target.closest('.herme-remove-image')) return;
    event.target.closest('[data-id]')?.remove();
    sync();
  });
})();
