(function () {
  function initPaymentScript() {
    const container = document.querySelector('[data-room-type]');
    if (!container) return;

    const roomType = container.getAttribute('data-room-type') || 'regular';
    const capacityType = container.getAttribute('data-capacity-type') || 'single';
    const basePath = container.getAttribute('data-base-path') || '/ReservationJaculbeTajarros';
    
    const elName = document.getElementById('cust_name');
    const elEmail = document.getElementById('cust_email');
    const elContact = document.getElementById('cust_contact');
    const elPayment = document.getElementById('payment_type');
    const creditFields = document.getElementById('credit_fields');
    const chequeFields = document.getElementById('cheque_fields');
    const btnNext = document.getElementById('open_reservation_summary');

    const elCheckIn = document.getElementById('check_in_input');
    const elCheckOut = document.getElementById('check_out_input');
    const uiNights = document.getElementById('ui_nights');
    const dateWarning = document.getElementById('date_warning');

    const sumCustomer = document.getElementById('sum_customer');
    const sumEmail = document.getElementById('sum_email');
    const sumContact = document.getElementById('sum_contact');
    const sumPayment = document.getElementById('sum_payment');
    const sumNights = document.getElementById('sum_nights');
    const sumBase = document.getElementById('sum_base');
    const sumDiscount = document.getElementById('sum_discount');
    const sumCharge = document.getElementById('sum_charge');
    const sumTotal = document.getElementById('sum_total');

    const modal = document.getElementById('reservation_summary_modal');
    const modalNights = document.getElementById('modal_nights');
    const modalCheckIn = document.getElementById('modal_check_in');
    const modalCheckOut = document.getElementById('modal_check_out');
    const modalDateReserved = document.getElementById('modal_date_reserved');
    const modalCustomer = document.getElementById('modal_customer');
    const modalEmail = document.getElementById('modal_email');
    const modalContact = document.getElementById('modal_contact');
    const modalBase = document.getElementById('modal_base');
    const modalDiscount = document.getElementById('modal_discount');
    const modalCharge = document.getElementById('modal_charge');
    const modalTotal = document.getElementById('modal_total');

    function parseDate(val) {
      if (!val) return null;
      const d = new Date(val + 'T00:00:00');
      return Number.isNaN(d.getTime()) ? null : d;
    }

    function computeNights() {
      const inVal = elCheckIn ? (elCheckIn.value || '').trim() : '';
      const outVal = elCheckOut ? (elCheckOut.value || '').trim() : '';
      const dtIn = parseDate(inVal);
      const dtOut = parseDate(outVal);

      if (!dtIn || !dtOut) {
        return { nights: 0, valid: true, hasBoth: false };
      }
      const diffMs = dtOut.getTime() - dtIn.getTime();
      const nights = Math.floor(diffMs / (1000 * 60 * 60 * 24));
      if (nights <= 0) {
        return { nights: 0, valid: false, hasBoth: true };
      }
      return { nights, valid: true, hasBoth: true };
    }

    function validateForm() {
      const name = elName ? (elName.value || '').trim() : '';
      const email = elEmail ? (elEmail.value || '').trim() : '';
      const contact = elContact ? (elContact.value || '').trim() : '';
      const paymentType = elPayment ? (elPayment.value || '').trim() : '';

      if (name.length === 0 || email.length === 0 || contact.length === 0 || paymentType.length === 0) {
        return false;
      }

      // Validate email format
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        return false;
      }

      // Validate contact number (11 digits)
      if (contact.length !== 11 || !/^\d+$/.test(contact)) {
        return false;
      }

      if (paymentType === 'credit') {
        const cardNumber = document.getElementById('card_number')?.value?.trim() || '';
        const cardExp = document.getElementById('card_exp')?.value?.trim() || '';
        const cardCvc = document.getElementById('card_cvc')?.value?.trim() || '';
        const cardZip = document.getElementById('card_zip')?.value?.trim() || '';
        if (cardNumber.length === 0 || cardExp.length === 0 || cardCvc.length === 0 || cardZip.length === 0) {
          return false;
        }
      } else if (paymentType === 'cheque') {
        const chequeNumber = document.getElementById('cheque_number')?.value?.trim() || '';
        if (chequeNumber.length === 0) {
          return false;
        }
      }

      return true;
    }

    function updateButtonState() {
      if (!btnNext) return;
      const isValid = validateForm();
      btnNext.disabled = !isValid;
      
      if (isValid) {
        btnNext.classList.remove('bg-slate-300', 'cursor-not-allowed', 'hover:bg-slate-300');
        btnNext.classList.add('bg-[#1e88e5]', 'hover:bg-[#1565c0]');
      } else {
        btnNext.classList.remove('bg-[#1e88e5]', 'hover:bg-[#1565c0]');
        btnNext.classList.add('bg-slate-300', 'cursor-not-allowed', 'hover:bg-slate-300');
      }
    }

    // Call PHP calculation endpoint
    function updateCalculations() {
      return new Promise((resolve) => {
        const cal = computeNights();
        const nights = cal.nights;
        const paymentType = (elPayment && elPayment.value) ? elPayment.value : 'cash';

        // Update nights display
        if (uiNights) uiNights.textContent = nights ? String(nights) : '—';
        if (sumNights) sumNights.textContent = nights ? String(nights) : '—';
        if (dateWarning) dateWarning.classList.toggle('hidden', cal.valid || !cal.hasBoth);
        container.setAttribute('data-nights', String(nights));

        // Call PHP calculation API
        const formData = new FormData();
        formData.append('days', nights);
        formData.append('room_type', roomType);
        formData.append('room_capacity', capacityType);
        formData.append('payment_type', paymentType);

        fetch(basePath + '/?action=calculate', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          const contentType = response.headers.get('content-type');
          if (!contentType || !contentType.includes('application/json')) {
            return response.text().then(text => {
              throw new Error(`Expected JSON but got: ${text.substring(0, 100)}`);
            });
          }
          return response.json();
        })
        .then(data => {
          if (sumBase) sumBase.textContent = data.subTotal.toLocaleString('en-US');
          if (sumDiscount) sumDiscount.textContent = data.discount.toLocaleString('en-US');
          if (sumCharge) sumCharge.textContent = data.additionalCharge.toLocaleString('en-US');
          if (sumTotal) sumTotal.textContent = data.totalBill.toLocaleString('en-US');
          
          // Update customer/payment info
          if (sumCustomer) sumCustomer.textContent = (elName && elName.value.trim()) ? elName.value.trim() : '—';
          if (sumEmail) sumEmail.textContent = (elEmail && elEmail.value.trim()) ? elEmail.value.trim() : '—';
          if (sumContact) sumContact.textContent = (elContact && elContact.value.trim()) ? elContact.value.trim() : '—';
          
          const paymentLabel = paymentType === 'cheque' ? 'Cheque' : (paymentType === 'credit' ? 'Credit Card' : 'Cash');
          if (sumPayment) sumPayment.textContent = paymentLabel;

          updateButtonState();
          resolve(data);
        })
        .catch(error => {
          console.error('Calculation error:', error);
          resolve(null);
        });
      });
    }

    function togglePaymentFields() {
      const paymentType = (elPayment && elPayment.value) ? elPayment.value : 'cash';
      if (creditFields) creditFields.classList.toggle('hidden', paymentType !== 'credit');
      if (chequeFields) chequeFields.classList.toggle('hidden', paymentType !== 'cheque');
      updateCalculations().catch(error => {
        console.error('Error updating calculations:', error);
      });
    }

    // Input restrictions
    if (elName) {
      elName.addEventListener('input', function(e) {
        // Only allow letters and spaces
        e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '');
      });
      elName.addEventListener('input', () => updateCalculations().catch(error => console.error('Error updating calculations:', error)));
    }

    if (elEmail) {
      elEmail.addEventListener('input', () => updateCalculations().catch(error => console.error('Error updating calculations:', error)));
    }

    if (elContact) {
      elContact.addEventListener('input', function(e) {
        // Only allow numbers, max 11 digits
        e.target.value = e.target.value.replace(/\D/g, '').slice(0, 11);
      });
      elContact.addEventListener('input', () => updateCalculations().catch(error => console.error('Error updating calculations:', error)));
    }

    // Event listeners
    if (elPayment) {
      elPayment.addEventListener('change', togglePaymentFields);
    }

    ['input', 'change'].forEach((evt) => {
      if (elCheckIn) elCheckIn.addEventListener(evt, () => updateCalculations().catch(error => console.error('Error updating calculations:', error)));
      if (elCheckOut) elCheckOut.addEventListener(evt, () => updateCalculations().catch(error => console.error('Error updating calculations:', error)));
    });

    const cardNumber = document.getElementById('card_number');
    const cardExp = document.getElementById('card_exp');
    const cardCvc = document.getElementById('card_cvc');
    const cardZip = document.getElementById('card_zip');
    const chequeNumber = document.getElementById('cheque_number');

    // Input restrictions for payment fields
    if (cardExp) {
      cardExp.addEventListener('input', function(e) {
        // Only allow numbers and /
        e.target.value = e.target.value.replace(/[^\d/]/g, '');
        // Auto-format MM/YY
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
          value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        e.target.value = value;
      });
    }

    if (cardCvc) {
      cardCvc.addEventListener('input', function(e) {
        // Only allow numbers
        e.target.value = e.target.value.replace(/\D/g, '');
      });
    }

    if (chequeNumber) {
      chequeNumber.addEventListener('input', function(e) {
        // Only allow numbers
        e.target.value = e.target.value.replace(/\D/g, '');
      });
    }

    ['input', 'change'].forEach((evt) => {
      if (cardNumber) cardNumber.addEventListener(evt, updateButtonState);
      if (cardExp) cardExp.addEventListener(evt, updateButtonState);
      if (cardCvc) cardCvc.addEventListener(evt, updateButtonState);
      if (cardZip) cardZip.addEventListener(evt, updateButtonState);
      if (chequeNumber) chequeNumber.addEventListener(evt, updateButtonState);
    });

    async function openModal() {
      const modalEl = modal || document.getElementById('reservation_summary_modal');
      if (!modalEl) return;

      // Force recalculation before opening modal to ensure latest values
      await updateCalculations();

      // Update nights
      if (modalNights && sumNights) modalNights.textContent = sumNights.textContent || '—';

      // Update check in and check out dates
      if (modalCheckIn) {
        const inVal = elCheckIn ? (elCheckIn.value || '').trim() : '';
        modalCheckIn.textContent = inVal || '—';
      }
      if (modalCheckOut) {
        const outVal = elCheckOut ? (elCheckOut.value || '').trim() : '';
        modalCheckOut.textContent = outVal || '—';
      }

      // Date reserved is set in PHP, but we can ensure it's displayed
      if (modalDateReserved && !modalDateReserved.textContent) {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        modalDateReserved.textContent = `${year}-${month}-${day}`;
      }

      // Update customer info
      if (modalCustomer && sumCustomer) modalCustomer.textContent = sumCustomer.textContent || '—';
      if (modalEmail && sumEmail) modalEmail.textContent = sumEmail.textContent || '—';
      if (modalContact && sumContact) modalContact.textContent = sumContact.textContent || '—';

      // Update billing - copy values from summary (already formatted with commas)
      if (modalBase && sumBase) modalBase.textContent = sumBase.textContent || '0';
      if (modalDiscount && sumDiscount) modalDiscount.textContent = sumDiscount.textContent || '0';
      if (modalCharge && sumCharge) modalCharge.textContent = sumCharge.textContent || '0';
      if (modalTotal && sumTotal) modalTotal.textContent = sumTotal.textContent || '0';

      modalEl.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      const modalEl = modal || document.getElementById('reservation_summary_modal');
      if (!modalEl) return;
      modalEl.classList.add('hidden');
      document.body.style.overflow = '';
    }

    if (btnNext) {
      btnNext.addEventListener('click', async function () {
        if (!validateForm()) return;
        await updateCalculations();
        await openModal();
      });
    }

    document.addEventListener('click', function(e) {
      const target = e.target;
      const modalEl = modal || document.getElementById('reservation_summary_modal');
      if (!modalEl) return;
      
      if (target.id === 'reservation_summary_close' || 
          target.id === 'reservation_summary_back' ||
          (target.id === 'reservation_summary_backdrop' && target === e.target)) {
        closeModal();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeModal();
    });

    // Confirm button handler
    const btnConfirm = document.getElementById('reservation_summary_confirm');
    if (btnConfirm) {
      btnConfirm.addEventListener('click', async function() {
        // Ensure calculations are up to date before sending
        await updateCalculations();
        
        // Helper function to get numeric value from element, defaulting to '0'
        const getNumericValue = (element) => {
          if (!element) {
            console.warn('Element not found for numeric value');
            return '0';
          }
          const text = element.textContent ? element.textContent.trim() : '';
          // Remove commas and check if it's a valid number or '—'
          const cleaned = text.replace(/,/g, '').trim();
          if (cleaned === '' || cleaned === '—' || cleaned === 'undefined' || isNaN(cleaned)) {
            console.warn('Invalid numeric value:', text, 'defaulting to 0');
            return '0';
          }
          return cleaned;
        };
        
        // Debug: Log values before sending
        console.log('Sending reservation data:', {
          discount: getNumericValue(sumDiscount),
          base: getNumericValue(sumBase),
          charge: getNumericValue(sumCharge),
          total: getNumericValue(sumTotal)
        });

        // Collect all reservation data
        const reservationData = {
          customerName: elName ? elName.value.trim() : '',
          customerEmail: elEmail ? elEmail.value.trim() : '',
          customerContact: elContact ? elContact.value.trim() : '',
          roomName: document.getElementById('modal_room')?.textContent?.trim() || '—',
          checkIn: elCheckIn ? elCheckIn.value.trim() : '',
          checkOut: elCheckOut ? elCheckOut.value.trim() : '',
          nights: sumNights ? (sumNights.textContent?.trim() || '0') : '0',
          dateReserved: modalDateReserved ? (modalDateReserved.textContent?.trim() || '') : '',
          paymentType: elPayment ? elPayment.value : 'cash',
          base: getNumericValue(sumBase),
          discount: getNumericValue(sumDiscount),
          charge: getNumericValue(sumCharge),
          total: getNumericValue(sumTotal)
        };

        // Send email via mailer
        const formData = new FormData();
        Object.keys(reservationData).forEach(key => {
          formData.append(key, reservationData[key]);
        });

        try {
          const response = await fetch(basePath + '/utils/mailer.php', {
            method: 'POST',
            body: formData
          });

          const result = await response.text();
          
          if (response.ok) {
            // Redirect to home page
            window.location.href = basePath + '/?page=home';
          } else {
            console.error('Email sending failed:', result);
            alert('Failed to send confirmation email. Please try again.');
          }
        } catch (error) {
          console.error('Error sending email:', error);
          alert('An error occurred while sending the confirmation email. Please try again.');
        }
      });
    }

    // Initialize
    updateCalculations().catch(error => {
      console.error('Error initializing calculations:', error);
    });
    updateButtonState();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPaymentScript);
  } else {
    initPaymentScript();
  }
})();

