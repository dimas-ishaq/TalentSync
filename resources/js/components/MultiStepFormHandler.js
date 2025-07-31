export default class MultiStepFormHandler {
    constructor(config) {
        this.config = {
            formElement: "form",
            formStepsSelector: ".form-steps",
            nextButtonId: "btnNext",
            previousButtonId: "btnPrevious",
            saveButtonId: "btnSave",
            progressBarSelector: ".custom-progress-bar i",
            activeClass: "text-primary",
            inactiveClass: "text-secondary",
            hiddenClass: "d-none",
            validClass: "is-valid",
            invalidClass: "is-invalid",
            errorClass: "invalid-feedback",
            ...config,
        };

        this.currentStep = 0;
        this.formSteps = [];
        this.validationRules = [];
        this.customValidators = {};

        this.init();
    }

    init() {
        this.bindElements();
        this.setupEventListeners();
        this.initializeForm();
    }

    bindElements() {
        this.btnNext = document.getElementById(this.config.nextButtonId);
        this.btnPrevious = document.getElementById(
            this.config.previousButtonId
        );
        this.btnSave = document.getElementById(this.config.saveButtonId);
        this.formSteps = document.querySelectorAll(
            this.config.formStepsSelector
        );
        this.progressBar = document.querySelectorAll(
            this.config.progressBarSelector
        );
        //
        this.mainForm = document.getElementById(this.config.formElement);
    }

    setupEventListeners() {
        if (this.btnNext) {
            this.btnNext.addEventListener("click", () => this.goToNextStep());
        }
        if (this.btnPrevious) {
            this.btnPrevious.addEventListener("click", () =>
                this.goToPreviousStep()
            );
        }
        if (this.btnSave) {
            this.btnSave.addEventListener("click", (e) => this.handleSave(e));
        }
    }

    // Add validation rules for each step
    addValidationRules(stepIndex, rules) {
        this.validationRules[stepIndex] = rules;
    }

    // Add custom validator functions
    addCustomValidator(name, validatorFunction) {
        this.customValidators[name] = validatorFunction;
    }

    // Built-in validation methods
    validateRequired(element, message = "Field tidak boleh kosong") {
        if (!element.value.trim()) {
            this.displayError(element, message);
            return false;
        }
        this.removeError(element);
        return true;
    }

    validateMinLength(
        element,
        minLength,
        message = `Minimal ${minLength} karakter`
    ) {
        if (element.value.trim().length < minLength) {
            this.displayError(element, message);
            return false;
        }
        this.removeError(element);
        return true;
    }

    validateMaxLength(
        element,
        maxLength,
        message = `Maksimal ${maxLength} karakter`
    ) {
        if (element.value.trim().length > maxLength) {
            this.displayError(element, message);
            return false;
        }
        this.removeError(element);
        return true;
    }

    validateEmail(element, message = "Format email tidak valid") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(element.value.trim())) {
            this.displayError(element, message);
            return false;
        }
        this.removeError(element);
        return true;
    }

    validatePhone(element, message = "Format nomor telepon tidak valid") {
        const phoneRegex = /^\d{10,13}$/;
        if (!phoneRegex.test(element.value.trim())) {
            this.displayError(element, message);
            return false;
        }
        this.removeError(element);
        return true;
    }

    validateSelect(element, message = "Mohon pilih salah satu opsi") {
        if (!element.value.trim()) {
            this.displayError(element, message);
            return false;
        }
        this.removeError(element);
        return true;
    }

    validateDate(element, message = "Tanggal tidak valid") {
        const dateValue = element.value.trim();
        if (!dateValue) {
            this.displayError(element, "Tanggal tidak boleh kosong");
            return false;
        }

        const selectedDate = new Date(dateValue);
        const today = new Date();
        selectedDate.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);

        if (isNaN(selectedDate.getTime())) {
            this.displayError(element, "Format tanggal tidak valid");
            return false;
        }

        if (selectedDate > today) {
            this.displayError(element, "Tanggal tidak boleh di masa depan");
            return false;
        }

        this.removeError(element);
        return true;
    }

    displayError(element, message) {
        const parentElement = element.parentElement;

        element.classList.remove(this.config.validClass);
        element.classList.add(this.config.invalidClass);

        let errorElement = parentElement.querySelector(
            `.${this.config.errorClass}`
        );

        if (!errorElement) {
            errorElement = document.createElement("div");
            errorElement.classList.add(this.config.errorClass);
            parentElement.appendChild(errorElement);

            const feedback = parentElement.querySelector(
                `.${this.config.errorClass}`
            );
           
        }
        errorElement.textContent = message;
       
    }

    removeError(element) {
        
        const parentElement = element.parentElement;
       

        element.classList.remove(this.config.invalidClass);
        element.classList.add(this.config.validClass);

        const errorElement = parentElement.querySelector(
            `.${this.config.errorClass}`
        );

        if (errorElement) {
           
            errorElement.remove();
        }
    }

    validateCurrentStep() {
        const rules = this.validationRules[this.currentStep];
        if (!rules) return true;

        let isValid = true;

        rules.forEach((rule) => {
            const element = document.getElementById(rule.id);
            if (!element) {
                console.warn(`Element with ID '${rule.id}' not found`);
                return;
            }

            let fieldValid = true;

            // Run built-in validations
            if (rule.validations) {
                rule.validations.forEach((validation) => {
                    if (!fieldValid) return; // Skip if already invalid

                    switch (validation.type) {
                        case "required":
                            fieldValid = this.validateRequired(
                                element,
                                validation.message
                            );
                            break;
                        case "minLength":
                            fieldValid = this.validateMinLength(
                                element,
                                validation.value,
                                validation.message
                            );
                            break;
                        case "maxLength":
                            fieldValid = this.validateMaxLength(
                                element,
                                validation.value,
                                validation.message
                            );
                            break;
                        case "email":
                            fieldValid = this.validateEmail(
                                element,
                                validation.message
                            );
                            break;
                        case "phone":
                            fieldValid = this.validatePhone(
                                element,
                                validation.message
                            );
                            break;
                        case "select":
                            fieldValid = this.validateSelect(
                                element,
                                validation.message
                            );
                            break;
                        case "date":
                            fieldValid = this.validateDate(
                                element,
                                validation.message
                            );
                            break;
                        case "custom":
                            if (this.customValidators[validation.validator]) {
                                fieldValid = this.customValidators[
                                    validation.validator
                                ](element, validation.message);
                            }
                            break;
                    }
                });
            }

            if (!fieldValid) {
                isValid = false;
            }
        });

        return isValid;
    }

    initializeForm() {
        this.formSteps.forEach((step, index) => {
            if (index === 0) {
                step.classList.remove(this.config.hiddenClass);
            } else {
                step.classList.add(this.config.hiddenClass);
            }
        });
        this.updateButtonVisibility();
        this.updateProgressBar();
    }

    updateButtonVisibility() {
        if (this.btnPrevious) {
            if (this.currentStep === 0) {
                this.btnPrevious.classList.add(this.config.hiddenClass);
            } else {
                this.btnPrevious.classList.remove(this.config.hiddenClass);
            }
        }

        if (this.btnNext && this.btnSave) {
            if (this.currentStep === this.formSteps.length - 1) {
                this.btnNext.classList.add(this.config.hiddenClass);
                this.btnSave.classList.remove(this.config.hiddenClass);
            } else {
                this.btnNext.classList.remove(this.config.hiddenClass);
                this.btnSave.classList.add(this.config.hiddenClass);
            }
        }
    }

    updateProgressBar() {
        this.progressBar.forEach((icon, index) => {
            if (index === this.currentStep) {
                icon.classList.add(this.config.activeClass);
                icon.classList.remove(this.config.inactiveClass);
            } else {
                icon.classList.remove(this.config.activeClass);
                icon.classList.add(this.config.inactiveClass);
            }
        });
    }

    goToNextStep() {
        if (this.validateCurrentStep()) {
            if (this.currentStep < this.formSteps.length - 1) {
                this.formSteps[this.currentStep].classList.add(
                    this.config.hiddenClass
                );
                this.currentStep++;
                this.formSteps[this.currentStep].classList.remove(
                    this.config.hiddenClass
                );
                this.updateButtonVisibility();
                this.updateProgressBar();

                // Trigger custom event
                this.triggerEvent("stepChanged", {
                    step: this.currentStep,
                    direction: "next",
                });
            }
        }
    }

    goToPreviousStep() {
        if (this.currentStep > 0) {
            this.formSteps[this.currentStep].classList.add(
                this.config.hiddenClass
            );
            this.currentStep--;
            this.formSteps[this.currentStep].classList.remove(
                this.config.hiddenClass
            );
            this.updateButtonVisibility();
            this.updateProgressBar();

            // Trigger custom event
            this.triggerEvent("stepChanged", {
                step: this.currentStep,
                direction: "previous",
            });
        }
    }

    handleSave(e) {
        e.preventDefault();

        if (this.validateCurrentStep()) {
            // Validation passed! Now, submit the actual HTML form.
            if (this.mainForm) {
                // Ensure the button is not disabled to allow submission
                this.btnSave.disabled = true; // Optional: Disable to prevent double-clicks
                this.mainForm.submit(); // <--- This line will submit the form to your Laravel backend
            } else {
                console.error("Main form element not found. Cannot submit.");
            }
        } else {
            console.log("Validation failed on final step. Form not submitted.");
        }
    }

    getFormData() {
        const formData = {};
        this.formSteps.forEach((step, stepIndex) => {
            const inputs = step.querySelectorAll("input, select, textarea");
            inputs.forEach((input) => {
                if (input.id) {
                    formData[input.id] = input.value;
                }
            });
        });
        return formData;
    }

    triggerEvent(eventName, data) {
        const event = new CustomEvent(eventName, { detail: data });
        document.dispatchEvent(event);
    }

    // Public methods for external control
    goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < this.formSteps.length) {
            this.formSteps[this.currentStep].classList.add(
                this.config.hiddenClass
            );
            this.currentStep = stepIndex;
            this.formSteps[this.currentStep].classList.remove(
                this.config.hiddenClass
            );
            this.updateButtonVisibility();
            this.updateProgressBar();
        }
    }

    getCurrentStep() {
        return this.currentStep;
    }

    getTotalSteps() {
        return this.formSteps.length;
    }
}
