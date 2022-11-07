'use strict';

{
  const Header = document.getElementById('js-header');
  const HeaderButton = document.getElementById('js-headerButton');
  if (HeaderButton) {
    HeaderButton.addEventListener('click', () => {
      Header.classList.toggle('is-open')
    })
  }
}
