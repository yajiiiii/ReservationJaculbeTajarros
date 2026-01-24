/**
 * Date validation utilities for reservation forms
 */

// Format date to YYYY-MM-DD format
const formatDate = (date) => {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
};

// Get normalized date (set to midnight for proper date-only comparison)
const normalizeDate = (date) => {
  const normalized = new Date(date);
  normalized.setHours(0, 0, 0, 0);
  return normalized;
};

// Get date constraints
const getDateConstraints = () => {
  const today = normalizeDate(new Date());
  const oneYearFromNow = new Date(today);
  oneYearFromNow.setFullYear(today.getFullYear() + 1);
  
  return {
    today,
    oneYearFromNow,
    minDate: formatDate(today),
    maxDate: formatDate(oneYearFromNow)
  };
};

/**
 * Initialize date inputs with constraints (no default values)
 * @param {HTMLElement} checkInInput - Check-in date input element
 * @param {HTMLElement} checkOutInput - Check-out date input element
 */
const initializeDateInputs = (checkInInput, checkOutInput) => {
  const constraints = getDateConstraints();
  
  // Set min and max dates
  checkInInput.setAttribute('min', constraints.minDate);
  checkInInput.setAttribute('max', constraints.maxDate);
  checkOutInput.setAttribute('min', constraints.minDate);
  checkOutInput.setAttribute('max', constraints.maxDate);
  
  // Don't set default values - leave inputs empty for user to select
  // Check-out min will be updated when check-in is selected
};

/**
 * Update check-out min date when check-in changes
 * @param {HTMLElement} checkInInput - Check-in date input element
 * @param {HTMLElement} checkOutInput - Check-out date input element
 * @param {HTMLElement} checkInError - Check-in error element
 * @param {HTMLElement} checkOutError - Check-out error element
 */
const handleCheckInChange = (checkInInput, checkOutInput, checkInError, checkOutError) => {
  if (!checkInInput.value) {
    // If check-in is cleared, reset check-out min to today
    const constraints = getDateConstraints();
    checkOutInput.setAttribute('min', constraints.minDate);
    // Clear check-out value if it exists
    if (checkOutInput.value) {
      checkOutInput.value = '';
    }
  } else {
    const checkInDate = normalizeDate(new Date(checkInInput.value));
    const minCheckOut = new Date(checkInDate);
    minCheckOut.setDate(minCheckOut.getDate() + 1);
    
    const minCheckOutStr = formatDate(minCheckOut);
    checkOutInput.setAttribute('min', minCheckOutStr);
    
    // If current check-out is before new minimum, clear it
    if (checkOutInput.value) {
      const currentCheckOut = normalizeDate(new Date(checkOutInput.value));
      if (currentCheckOut <= checkInDate) {
        checkOutInput.value = '';
      }
    }
  }
  
  // Clear errors
  if (checkInError) checkInError.classList.add('hidden');
  if (checkOutError) checkOutError.classList.add('hidden');
};

/**
 * Validate check-out when it changes
 * @param {HTMLElement} checkInInput - Check-in date input element
 * @param {HTMLElement} checkOutInput - Check-out date input element
 * @param {HTMLElement} checkOutError - Check-out error element
 */
const handleCheckOutChange = (checkInInput, checkOutInput, checkOutError) => {
  const checkInDate = normalizeDate(new Date(checkInInput.value));
  const checkOutDate = normalizeDate(new Date(checkOutInput.value));
  const minCheckOut = new Date(checkInDate);
  minCheckOut.setDate(minCheckOut.getDate() + 1);

  if (checkOutDate <= checkInDate) {
    if (checkOutError) {
      checkOutError.textContent = 'Check-out must be at least one day after check-in';
      checkOutError.classList.remove('hidden');
    }
    checkOutInput.setCustomValidity('Check-out must be at least one day after check-in');
  } else {
    if (checkOutError) checkOutError.classList.add('hidden');
    checkOutInput.setCustomValidity('');
  }
};

/**
 * Validate form dates
 * @param {HTMLElement} checkInInput - Check-in date input element
 * @param {HTMLElement} checkOutInput - Check-out date input element
 * @param {HTMLElement} checkInError - Check-in error element
 * @param {HTMLElement} checkOutError - Check-out error element
 * @returns {boolean} - Returns true if validation passes, false otherwise
 */
const validateFormDates = (checkInInput, checkOutInput, checkInError, checkOutError) => {
  const constraints = getDateConstraints();
  
  // Clear previous errors
  if (checkInError) checkInError.classList.add('hidden');
  if (checkOutError) checkOutError.classList.add('hidden');

  // Validate dates - normalize to midnight for proper date-only comparison
  const checkInDate = normalizeDate(new Date(checkInInput.value));
  const checkOutDate = normalizeDate(new Date(checkOutInput.value));
  const minCheckOut = new Date(checkInDate);
  minCheckOut.setDate(minCheckOut.getDate() + 1);

  let isValid = true;

  // Validate check-in
  if (!checkInInput.value) {
    if (checkInError) {
      checkInError.textContent = 'Please select a check-in date';
      checkInError.classList.remove('hidden');
    }
    isValid = false;
  } else if (checkInDate < constraints.today) {
    if (checkInError) {
      checkInError.textContent = 'Check-in date cannot be in the past';
      checkInError.classList.remove('hidden');
    }
    isValid = false;
  } else if (checkInDate > constraints.oneYearFromNow) {
    if (checkInError) {
      checkInError.textContent = 'Check-in date cannot be more than one year from now';
      checkInError.classList.remove('hidden');
    }
    isValid = false;
  }

  // Validate check-out
  if (!checkOutInput.value) {
    if (checkOutError) {
      checkOutError.textContent = 'Please select a check-out date';
      checkOutError.classList.remove('hidden');
    }
    isValid = false;
  } else if (checkOutDate <= checkInDate) {
    if (checkOutError) {
      checkOutError.textContent = 'Check-out must be at least one day after check-in';
      checkOutError.classList.remove('hidden');
    }
    isValid = false;
  }

  return isValid;
};

// Export functions for use in other files
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    initializeDateInputs,
    handleCheckInChange,
    handleCheckOutChange,
    validateFormDates,
    formatDate,
    getDateConstraints
  };
} else {
  // Browser environment - attach to window
  window.DateValidation = {
    initializeDateInputs,
    handleCheckInChange,
    handleCheckOutChange,
    validateFormDates,
    formatDate,
    getDateConstraints
  };
}

