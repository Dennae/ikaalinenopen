/**
 * Accordion Component
 *
 * Sets attribute "aria-expanded" to true/false, which is used
 * in _component-accordion.scss to determine which accordion to display
 */

const x_accordion_init = (accordion, i) => {
  let tab = accordion;
  let panel = accordion.parentNode.querySelector('.js-accordion-panel');

  tab.setAttribute('aria-controls', 'accordion-' + i);
  panel.setAttribute('id', 'accordion-' + i);
  panel.setAttribute('aria-labelledby', 'accordion-' + i);
};

const x_accordion_focus = (e) => {
  let tab = e.currentTarget;

  if (tab.getAttribute('aria-selected') === 'true') {
    tab.setAttribute('aria-selected', 'false');
  } else {
    tab.setAttribute('aria-selected', 'true');
  }
};

const x_accordion_toggle = (e) => {
  e.stopPropagation();

  let tab = e.currentTarget;
  let panel = e.currentTarget.parentNode.querySelector('.js-accordion-panel');

  if (tab.getAttribute('aria-expanded') === 'true') {
    tab.setAttribute('aria-expanded', 'false');
    panel.setAttribute('aria-hidden', 'true');
  } else {
    tab.setAttribute('aria-expanded', 'true');
    panel.setAttribute('aria-hidden', 'false');
  }
};

const x_accordion_find_and_init = () => {
  let accordion = document.querySelectorAll('.js-accordion-header');
  for (let i = 0; i < accordion.length; i++) {
    x_accordion_init(accordion[i], i);

    accordion[i].addEventListener('click', x_accordion_toggle);
    accordion[i].addEventListener('focus', x_accordion_focus);
    accordion[i].addEventListener('blur', x_accordion_focus);
  }
};

x_accordion_find_and_init();
