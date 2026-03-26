(function () {
  function initPaymentScript() {
    const container = document.querySelector('[data-room-type]');
    if (!container) return;

    const roomType = container.getAttribute('data-room-type') || 'regular';
    const capacityType = container.getAttribute('data-capacity-type') || 'single';
    const basePath = container.getAttribute('data-base-path') || '/ReservationJaculbeTajarros';
    const roomId = container.getAttribute('data-room-id') || '0';
    
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

    function validateForm(showErrors) {
      const errors = [];
      const name = elName ? (elName.value || '').trim() : '';
      const email = elEmail ? (elEmail.value || '').trim() : '';
      const contact = elContact ? (elContact.value || '').trim() : '';
      const paymentType = elPayment ? (elPayment.value || '').trim() : '';
      const cal = computeNights();

      // Date validation
      const checkInVal = elCheckIn ? (elCheckIn.value || '').trim() : '';
      const checkOutVal = elCheckOut ? (elCheckOut.value || '').trim() : '';
      if (!checkInVal || !checkOutVal) {
        errors.push('Please select check-in and check-out dates to compute total bill.');
      } else if (!cal.valid || cal.nights <= 0) {
        errors.push('Check-out date must be after check-in date.');
      }

      // Room capacity check
      if (!capacityType || capacityType === '') {
        errors.push('No selected room capacity.');
      }

      // Room type check
      if (!roomType || roomType === '') {
        errors.push('No selected room type.');
      }

      // Customer fields
      if (name.length === 0) {
        errors.push('Customer name is required.');
      }
      if (email.length === 0) {
        errors.push('Email is required.');
      } else {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          errors.push('Please enter a valid email address.');
        }
      }
      if (contact.length === 0) {
        errors.push('Contact number is required.');
      } else if (contact.length !== 11 || !/^\d+$/.test(contact)) {
        errors.push('Contact number must be exactly 11 digits.');
      }

      // Payment type check
      if (!paymentType || paymentType === '') {
        errors.push('No selected type of payment.');
      }

      // Payment-specific fields
      if (paymentType === 'credit') {
        const cardNumber = document.getElementById('card_number')?.value?.trim() || '';
        const cardExp = document.getElementById('card_exp')?.value?.trim() || '';
        const cardCvc = document.getElementById('card_cvc')?.value?.trim() || '';
        const cardZip = document.getElementById('card_zip')?.value?.trim() || '';
        if (!cardNumber || !cardExp || !cardCvc || !cardZip) {
          errors.push('Please fill in all credit card details.');
        }
      } else if (paymentType === 'cheque') {
        const chequeNumber = document.getElementById('cheque_number')?.value?.trim() || '';
        if (!chequeNumber) {
          errors.push('Please enter the cheque number.');
        }
      }

      // Show error toast if requested
      if (showErrors && errors.length > 0) {
        showValidationErrors(errors);
      }

      return errors.length === 0;
    }

    function showValidationErrors(errors) {
      // Remove existing error toast
      const existing = document.getElementById('validation-error-toast');
      if (existing) existing.remove();

      const toast = document.createElement('div');
      toast.id = 'validation-error-toast';
      toast.className = 'fixed top-6 right-6 z-[8000] max-w-sm w-full animate-slide-in-right';
      toast.innerHTML = `
        <div class="rounded-2xl bg-white border border-red-200 shadow-xl p-4">
          <div class="flex items-start gap-3">
            <div class="flex-shrink-0 mt-0.5">
              <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
              </svg>
            </div>
            <div class="flex-1">
              <h4 class="text-sm font-black text-[#023e7d]">Incomplete Information</h4>
              <ul class="mt-2 space-y-1">
                ${errors.map(e => `<li class="text-xs text-red-600 flex items-start gap-1.5"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-red-400 flex-shrink-0"></span>${e}</li>`).join('')}
              </ul>
            </div>
            <button onclick="this.closest('#validation-error-toast').remove()" class="flex-shrink-0 p-1 rounded-lg hover:bg-slate-100 transition cursor-pointer">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
          </div>
        </div>
      `;
      document.body.appendChild(toast);

      // Auto-remove after 6 seconds
      setTimeout(() => {
        if (toast.parentNode) toast.remove();
      }, 6000);
    }

    function updateButtonState() {
      if (!btnNext) return;
      const isValid = validateForm(false);
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
      // Always enable the button so users can click and see errors
      btnNext.disabled = false;
      btnNext.classList.remove('bg-slate-300', 'cursor-not-allowed', 'hover:bg-slate-300');
      btnNext.classList.add('bg-[#1e88e5]', 'hover:bg-[#1565c0]', 'cursor-pointer');

      btnNext.addEventListener('click', async function () {
        if (!validateForm(true)) return;
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
          room_id: roomId,
          customerName: elName ? elName.value.trim() : '',
          customerEmail: elEmail ? elEmail.value.trim() : '',
          customerContact: elContact ? elContact.value.trim() : '',
          checkIn: elCheckIn ? elCheckIn.value.trim() : '',
          checkOut: elCheckOut ? elCheckOut.value.trim() : '',
          paymentType: elPayment ? elPayment.value : 'cash',
          base: getNumericValue(sumBase),
          discount: getNumericValue(sumDiscount),
          charge: getNumericValue(sumCharge),
          total: getNumericValue(sumTotal)
        };

        // Save reservation to database
        const formData = new FormData();
        Object.keys(reservationData).forEach(key => {
          formData.append(key, reservationData[key]);
        });

        try {
          const response = await fetch(basePath + '/utils/save_reservation.php', {
            method: 'POST',
            body: formData
          });

          const result = await response.json();

          if (result.success) {
            // Close the reservation summary modal
            const modalEl = modal || document.getElementById('reservation_summary_modal');
            if (modalEl) {
              modalEl.classList.add('hidden');
            }

            // Show success UI overlay
            const successOverlay = document.createElement('div');
            successOverlay.id = 'reservation_success_overlay';
            successOverlay.className = 'fixed inset-0 z-[7000] flex items-center justify-center p-4';
            successOverlay.innerHTML = `
              <div class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>
              <div class="relative w-full max-w-md rounded-3xl bg-white shadow-2xl overflow-hidden text-center">
                <div class="pt-10 pb-4 px-6">
                  <div class="mx-auto mb-6 flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100">
                    <svg class="w-10 h-10 text-emerald-500 animate-[scale-in_0.4s_ease-out]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <h3 class="text-2xl font-black text-[#023e7d] tracking-tight">Reservation Confirmed!</h3>
                  <p class="text-sm text-[#023e7d]/60 mt-2 leading-relaxed">Your booking has been successfully saved. You can view your reservation details in the admin panel.</p>
                </div>

                <div class="mx-6 mb-6 rounded-2xl bg-slate-50 border border-slate-200 p-4 text-left space-y-2">
                  <div class="flex justify-between text-sm">
                    <span class="text-[#023e7d]/50">Room</span>
                    <span class="font-semibold text-[#023e7d]">${document.getElementById('modal_room')?.textContent || '—'}</span>
                  </div>
                  <div class="flex justify-between text-sm">
                    <span class="text-[#023e7d]/50">Guest</span>
                    <span class="font-semibold text-[#023e7d]">${elName ? elName.value.trim() : '—'}</span>
                  </div>
                  <div class="flex justify-between text-sm">
                    <span class="text-[#023e7d]/50">Dates</span>
                    <span class="font-semibold text-[#023e7d]">${elCheckIn?.value || '—'} → ${elCheckOut?.value || '—'}</span>
                  </div>
                  <div class="h-px bg-slate-200"></div>
                  <div class="flex justify-between text-base">
                    <span class="font-black text-[#023e7d]">Total</span>
                    <span class="font-black text-[#1e88e5]">₱${getNumericValue(sumTotal) !== '0' ? Number(getNumericValue(sumTotal)).toLocaleString() : '0'}</span>
                  </div>
                </div>

                <div class="px-6 pb-8 flex gap-3">
                  <a href="${basePath}/?page=home" class="flex-1 inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-[#023e7d] hover:bg-slate-50 transition">
                    Back to Home
                  </a>
                  <a href="${basePath}/?page=home" class="flex-1 inline-flex items-center justify-center rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white hover:bg-[#1565c0] transition">
                    Ok
                  </a>
                </div>
              </div>
            `;
            document.body.appendChild(successOverlay);
            document.body.style.overflow = 'hidden';
          } else {
            alert(result.error || 'Failed to save reservation. Please try again.');
          }
        } catch (error) {
          console.error('Error saving reservation:', error);
          alert('An error occurred. Please try again.');
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

