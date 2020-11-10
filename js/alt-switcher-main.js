let buttons = document.querySelectorAll('.switch-button')

buttons.forEach((button) => {
  button.addEventListener('click', () => {
    let parent = button.parentElement;
    let main = parent.querySelector('.main')
    let alt = parent.querySelector('.alt')
    main.classList.toggle('hide')
    alt.classList.toggle('hide')
  });
});