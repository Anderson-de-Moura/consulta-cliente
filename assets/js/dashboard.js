(() => {
    const form = document.querySelector('#consultation-form');
    if (!form) return;

    const cpfInput = form.querySelector('.cpf-input');
    const legalBasis = form.querySelector('[name="justificativa_lgpd"]');
    const consent = form.querySelector('#legal-consent');
    const submit = form.querySelector('.consultation-submit');

    const formatCpf = (value) => {
        const digits = value.replace(/\D/g, '').slice(0, 11);
        return digits
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    };

    const updateSubmitState = () => {
        const digitCount = cpfInput.value.replace(/\D/g, '').length;
        submit.disabled = digitCount !== 11 || !legalBasis.value || !consent.checked;
    };

    cpfInput.addEventListener('input', () => {
        cpfInput.value = formatCpf(cpfInput.value);
        updateSubmitState();
    });
    legalBasis.addEventListener('change', updateSubmitState);
    consent.addEventListener('change', updateSubmitState);
    form.addEventListener('submit', () => {
        submit.disabled = true;
        submit.textContent = 'Consultando...';
    });
})();