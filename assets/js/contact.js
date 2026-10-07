(() => {
  'use strict';

  const form = document.querySelector('[data-contact-form]');
  if (!form) return;
  const topic = form.querySelector('#contact-topic');
  const reservationFields = form.querySelector('[data-reservation-fields]');
  const message = form.querySelector('#contact-message');
  const messageLabel = form.querySelector('[data-message-label]');
  const messageRequired = form.querySelector('[data-message-required]');
  const guests = form.querySelector('#contact-guests');
  const submit = form.querySelector('button[type="submit"]');
  const submitLabel = form.querySelector('[data-submit-label]');
  if (!topic || !reservationFields || !message || !messageLabel || !messageRequired || !guests || !submit || !submitLabel) return;
  const reservationInputs = [...reservationFields.querySelectorAll('input')];
  const controls = [...form.querySelectorAll('input:not([name="website"]), select, textarea')];
  const fieldErrors = new Map();
  let sending = false;

  // Native form submission and validation remain in charge; these hints add context.
  controls.forEach(control => {
    const error = document.createElement('span');
    error.className = 'contact-field-error';
    error.id = control.id + '-error';
    error.hidden = true;
    error.setAttribute('aria-live', 'polite');
    control.after(error);
    fieldErrors.set(control, error);
    const describedBy = control.getAttribute('aria-describedby');
    control.setAttribute('aria-describedby', [describedBy, error.id].filter(Boolean).join(' '));
  });

  const clearError = control => {
    const error = fieldErrors.get(control);
    if (!error) return;
    control.removeAttribute('aria-invalid');
    error.textContent = '';
    error.hidden = true;
  };
  const showError = control => {
    const error = fieldErrors.get(control);
    if (!error) return;
    control.setAttribute('aria-invalid', 'true');
    let text = control.validationMessage;
    if (control.validity.valueMissing) text = 'Vul dit veld in.';
    else if (control.type === 'email' && control.validity.typeMismatch) text = 'Vul een geldig e-mailadres in.';
    else if (control.id === 'contact-date') text = 'Kies een geldige datum vanaf vandaag en binnen het komende jaar.';
    else if (control.id === 'contact-guests') text = 'Vul een heel aantal personen in tussen 1 en 99.';
    else if (control.id === 'contact-time') text = 'Kies een geldig tijdstip, bijvoorbeeld 18:30.';
    error.textContent = text;
    error.hidden = false;
  };
  const validateGuests = () => {
    guests.setCustomValidity(!guests.disabled && guests.value !== '' && !/^[1-9][0-9]?$/.test(guests.value)
      ? 'Vul een heel aantal personen in tussen 1 en 99.' : '');
  };

  const updateTopic = () => {
    const reservation = topic.value === 'reservatie';
    reservationFields.hidden = !reservation;
    reservationInputs.forEach(input => {
      input.disabled = !reservation;
      input.required = reservation;
      if (!reservation) clearError(input);
    });
    validateGuests();
    message.required = !reservation;
    messageRequired.hidden = reservation;
    messageLabel.textContent = reservation ? 'Extra wensen (optioneel)' : 'Bericht';
    submitLabel.textContent = reservation ? 'Verstuur aanvraag' : 'Verstuur bericht';
    clearError(message);
  };
  topic.addEventListener('change', updateTopic);
  updateTopic();

  form.addEventListener('invalid', event => showError(event.target), true);
  form.addEventListener('input', event => {
    const control = event.target;
    if (control === guests) validateGuests();
    if (!fieldErrors.has(control) || !control.hasAttribute('aria-invalid')) return;
    if (control.validity.valid) clearError(control);
    else showError(control);
  });
  form.addEventListener('submit', event => {
    if (sending) { event.preventDefault(); return; }
    // An invalid form does not normally emit submit; retain this guard for integrations.
    if (!form.checkValidity()) { event.preventDefault(); form.reportValidity(); return; }
    sending = true;
    submit.disabled = true;
    submitLabel.textContent = 'Versturen…';
    form.setAttribute('aria-busy', 'true');
  });
  // Restore usability when a browser brings a submitted page back from its cache.
  window.addEventListener('pageshow', () => {
    sending = false;
    submit.disabled = false;
    form.removeAttribute('aria-busy');
    updateTopic();
  });
})();
