/**
 * Pahinga Admin Panel - JavaScript
 * Handles CRUD operations, modals, and dashboard rendering
 */

// ─── UTILITIES ──────────────────────────────────────────

function showToast(message) {
  const toast = document.getElementById('admin-toast');
  const msg = document.getElementById('admin-toast-message');
  if (!toast || !msg) return;
  msg.textContent = message;
  toast.classList.remove('hidden');
  setTimeout(() => toast.classList.add('hidden'), 3000);
}

function statusBadge(status) {
  const colors = {
    available: 'bg-emerald-100 text-emerald-700',
    occupied: 'bg-amber-100 text-amber-700',
    maintenance: 'bg-red-100 text-red-700',
    pending: 'bg-amber-100 text-amber-700',
    confirmed: 'bg-[#1e88e5]/10 text-[#1e88e5]',
    checked_in: 'bg-emerald-100 text-emerald-700',
    checked_out: 'bg-slate-100 text-slate-600',
    cancelled: 'bg-red-100 text-red-700',
  };
  const label = status.replace('_', ' ');
  const cls = colors[status] || 'bg-slate-100 text-slate-600';
  return `<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize ${cls}">${label}</span>`;
}

function apiPost(action, data) {
  const formData = new FormData();
  for (const key in data) {
    formData.append(key, data[key]);
  }
  return fetch(API_BASE + '?action=' + action, {
    method: 'POST',
    body: formData,
  }).then(r => r.json());
}

function apiGet(action, params) {
  const url = new URL(API_BASE, window.location.origin);
  url.searchParams.set('action', action);
  if (params) {
    for (const key in params) {
      if (params[key]) url.searchParams.set(key, params[key]);
    }
  }
  return fetch(url.toString()).then(r => r.json());
}

// ─── DASHBOARD ──────────────────────────────────────────

function loadDashboard() {
  apiGet('get_stats').then(res => {
    if (!res.success) return;
    const d = res.data;

    const el = (id) => document.getElementById(id);
    if (el('stat-total-rooms')) el('stat-total-rooms').textContent = d.total_rooms;
    if (el('stat-available-rooms')) el('stat-available-rooms').textContent = d.available_rooms;
    if (el('stat-total-reservations')) el('stat-total-reservations').textContent = d.total_reservations;
    if (el('stat-revenue')) el('stat-revenue').textContent = '₱' + Number(d.total_revenue).toLocaleString();

    const tbody = el('recent-reservations-body');
    if (!tbody) return;

    if (!d.recent_reservations || d.recent_reservations.length === 0) {
      tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-8 text-center text-[#023e7d]/40">No reservations yet</td></tr>';
      return;
    }

    tbody.innerHTML = d.recent_reservations.map(r => `
      <tr class="hover:bg-slate-50 transition">
        <td class="px-6 py-4">
          <p class="font-semibold text-[#023e7d]">${escHtml(r.customer_name)}</p>
          <p class="text-xs text-[#023e7d]/50">${escHtml(r.customer_email)}</p>
        </td>
        <td class="px-6 py-4 text-[#023e7d]">${escHtml(r.room_name)}</td>
        <td class="px-6 py-4 text-[#023e7d]">${r.check_in}</td>
        <td class="px-6 py-4 font-semibold text-[#023e7d]">₱${Number(r.total_bill).toLocaleString()}</td>
        <td class="px-6 py-4">${statusBadge(r.status)}</td>
      </tr>
    `).join('');
  });
}

// ─── ROOMS CRUD ─────────────────────────────────────────

function loadRooms() {
  const type = document.getElementById('rooms-filter-type')?.value || '';
  const search = document.getElementById('rooms-search')?.value || '';

  apiGet('get_rooms', { type, search }).then(res => {
    const tbody = document.getElementById('rooms-table-body');
    if (!tbody) return;

    if (!res.success || !res.data || res.data.length === 0) {
      tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-8 text-center text-[#023e7d]/40">No rooms found</td></tr>';
      return;
    }

    tbody.innerHTML = res.data.map(room => `
      <tr class="hover:bg-slate-50 transition">
        <td class="px-6 py-4 text-[#023e7d]/60">${room.id}</td>
        <td class="px-6 py-4">
          <p class="font-semibold text-[#023e7d]">${escHtml(room.name)}</p>
          <p class="text-xs text-[#023e7d]/50 max-w-xs truncate">${escHtml(room.description)}</p>
        </td>
        <td class="px-6 py-4"><span class="inline-flex items-center rounded-full bg-[#1e88e5]/10 px-2.5 py-0.5 text-xs font-semibold text-[#1e88e5] capitalize">${room.type}</span></td>
        <td class="px-6 py-4 text-[#023e7d]">${escHtml(room.capacity)}</td>
        <td class="px-6 py-4 font-semibold text-[#023e7d]">₱${Number(room.price).toLocaleString()}</td>
        <td class="px-6 py-4">${statusBadge(room.status)}</td>
        <td class="px-6 py-4 text-right">
          <div class="flex items-center justify-end gap-2">
            <button onclick="editRoom(${room.id})" class="p-2 rounded-xl hover:bg-[#1e88e5]/10 transition cursor-pointer" title="Edit">
              <svg class="w-4 h-4 text-[#1e88e5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button onclick="deleteRoom(${room.id}, '${escHtml(room.name)}')" class="p-2 rounded-xl hover:bg-red-50 transition cursor-pointer" title="Delete">
              <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
    `).join('');
  });
}

function openRoomModal(room) {
  const modal = document.getElementById('room-modal');
  const title = document.getElementById('room-modal-title');
  modal.classList.remove('hidden');
  modal.classList.add('flex');

  if (room) {
    title.textContent = 'Edit Room';
    document.getElementById('room-id').value = room.id;
    document.getElementById('room-name').value = room.name;
    document.getElementById('room-type').value = room.type;
    document.getElementById('room-description').value = room.description;
    document.getElementById('room-detailed-description').value = room.detailed_description || '';
    document.getElementById('room-capacity').value = room.capacity;
    document.getElementById('room-price').value = room.price;
    document.getElementById('room-image').value = room.image || '';
    document.getElementById('room-image-dir').value = room.image_dir || '';
    document.getElementById('room-offers').value = room.offers || '';
    document.getElementById('room-status').value = room.status;
  } else {
    title.textContent = 'Add Room';
    document.getElementById('room-form').reset();
    document.getElementById('room-id').value = '';
  }
}

function closeRoomModal() {
  const modal = document.getElementById('room-modal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function saveRoom(e) {
  e.preventDefault();
  const id = document.getElementById('room-id').value;
  const action = id ? 'update_room' : 'create_room';

  const data = {
    name: document.getElementById('room-name').value,
    type: document.getElementById('room-type').value,
    description: document.getElementById('room-description').value,
    detailed_description: document.getElementById('room-detailed-description').value,
    capacity: document.getElementById('room-capacity').value,
    price: document.getElementById('room-price').value,
    image: document.getElementById('room-image').value,
    image_dir: document.getElementById('room-image-dir').value,
    offers: document.getElementById('room-offers').value,
    status: document.getElementById('room-status').value,
  };
  if (id) data.id = id;

  apiPost(action, data).then(res => {
    if (res.success) {
      showToast(res.message);
      closeRoomModal();
      loadRooms();
    } else {
      alert(res.message || 'Error saving room');
    }
  });
}

function editRoom(id) {
  apiGet('get_room', { id }).then(res => {
    if (res.success) {
      openRoomModal(res.data);
    }
  });
}

function deleteRoom(id, name) {
  if (!confirm('Delete "' + name + '"? This will also delete all associated reservations.')) return;
  apiPost('delete_room', { id }).then(res => {
    if (res.success) {
      showToast(res.message);
      loadRooms();
    }
  });
}

// ─── RESERVATIONS CRUD ──────────────────────────────────

function loadReservations() {
  const status = document.getElementById('reservations-filter-status')?.value || '';
  const search = document.getElementById('reservations-search')?.value || '';

  apiGet('get_reservations', { status, search }).then(res => {
    const tbody = document.getElementById('reservations-table-body');
    if (!tbody) return;

    if (!res.success || !res.data || res.data.length === 0) {
      tbody.innerHTML = '<tr><td colspan="8" class="px-6 py-8 text-center text-[#023e7d]/40">No reservations found</td></tr>';
      return;
    }

    tbody.innerHTML = res.data.map(r => `
      <tr class="hover:bg-slate-50 transition">
        <td class="px-6 py-4 text-[#023e7d]/60">${r.id}</td>
        <td class="px-6 py-4">
          <p class="font-semibold text-[#023e7d]">${escHtml(r.customer_name)}</p>
          <p class="text-xs text-[#023e7d]/50">${escHtml(r.customer_email)}</p>
        </td>
        <td class="px-6 py-4">
          <p class="text-[#023e7d]">${escHtml(r.room_name)}</p>
          <p class="text-xs text-[#023e7d]/50 capitalize">${r.room_type}</p>
        </td>
        <td class="px-6 py-4">
          <p class="text-[#023e7d] text-xs">${r.check_in} &rarr; ${r.check_out}</p>
          <p class="text-xs text-[#023e7d]/50">${r.nights} night(s)</p>
        </td>
        <td class="px-6 py-4 capitalize text-[#023e7d]">${r.payment_type}</td>
        <td class="px-6 py-4 font-semibold text-[#023e7d]">₱${Number(r.total_bill).toLocaleString()}</td>
        <td class="px-6 py-4">${statusBadge(r.status)}</td>
        <td class="px-6 py-4 text-right">
          <div class="flex items-center justify-end gap-1">
            <button onclick="viewReservation(${r.id})" class="p-2 rounded-xl hover:bg-[#1e88e5]/10 transition cursor-pointer" title="View">
              <svg class="w-4 h-4 text-[#1e88e5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
            <select onchange="updateReservationStatus(${r.id}, this.value)" class="text-xs rounded-xl border border-slate-200 px-2 py-1 text-[#023e7d] outline-none cursor-pointer">
              <option value="" disabled selected>Update</option>
              <option value="pending">Pending</option>
              <option value="confirmed">Confirmed</option>
              <option value="checked_in">Checked In</option>
              <option value="checked_out">Checked Out</option>
              <option value="cancelled">Cancelled</option>
            </select>
            <button onclick="deleteReservation(${r.id})" class="p-2 rounded-xl hover:bg-red-50 transition cursor-pointer" title="Delete">
              <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
    `).join('');
  });
}

function openReservationModal() {
  const modal = document.getElementById('reservation-modal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  document.getElementById('reservation-form').reset();

  // Load rooms into select
  apiGet('get_rooms').then(res => {
    const select = document.getElementById('res-room-id');
    select.innerHTML = '<option value="">Select a room...</option>';
    if (res.success && res.data) {
      res.data.forEach(room => {
        select.innerHTML += `<option value="${room.id}">${room.name} (${room.type}) - ₱${Number(room.price).toLocaleString()}/night</option>`;
      });
    }
  });
}

function closeReservationModal() {
  const modal = document.getElementById('reservation-modal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function saveReservation(e) {
  e.preventDefault();

  const data = {
    room_id: document.getElementById('res-room-id').value,
    customer_name: document.getElementById('res-name').value,
    customer_email: document.getElementById('res-email').value,
    customer_contact: document.getElementById('res-contact').value,
    payment_type: document.getElementById('res-payment').value,
    check_in: document.getElementById('res-checkin').value,
    check_out: document.getElementById('res-checkout').value,
  };

  apiPost('create_reservation', data).then(res => {
    if (res.success) {
      showToast(res.message);
      closeReservationModal();
      loadReservations();
    } else {
      alert(res.message || 'Error creating reservation');
    }
  });
}

function updateReservationStatus(id, status) {
  if (!status) return;
  apiPost('update_reservation_status', { id, status }).then(res => {
    if (res.success) {
      showToast(res.message);
      loadReservations();
    }
  });
}

function viewReservation(id) {
  apiGet('get_reservation', { id }).then(res => {
    if (!res.success) return;
    const r = res.data;
    const modal = document.getElementById('reservation-detail-modal');
    const content = document.getElementById('reservation-detail-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    content.innerHTML = `
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold text-[#023e7d]/50 uppercase">Reservation #${r.id}</span>
          ${statusBadge(r.status)}
        </div>

        <div class="rounded-2xl bg-slate-50 p-4 space-y-3">
          <h4 class="text-sm font-black text-[#1e88e5]">Customer Information</h4>
          <div class="grid grid-cols-2 gap-2 text-sm">
            <p class="text-[#023e7d]/50">Name</p><p class="font-semibold text-[#023e7d]">${escHtml(r.customer_name)}</p>
            <p class="text-[#023e7d]/50">Email</p><p class="font-semibold text-[#023e7d]">${escHtml(r.customer_email)}</p>
            <p class="text-[#023e7d]/50">Contact</p><p class="font-semibold text-[#023e7d]">${escHtml(r.customer_contact)}</p>
          </div>
        </div>

        <div class="rounded-2xl bg-slate-50 p-4 space-y-3">
          <h4 class="text-sm font-black text-[#1e88e5]">Booking Details</h4>
          <div class="grid grid-cols-2 gap-2 text-sm">
            <p class="text-[#023e7d]/50">Room</p><p class="font-semibold text-[#023e7d]">${escHtml(r.room_name)} (${r.room_type})</p>
            <p class="text-[#023e7d]/50">Check-in</p><p class="font-semibold text-[#023e7d]">${r.check_in}</p>
            <p class="text-[#023e7d]/50">Check-out</p><p class="font-semibold text-[#023e7d]">${r.check_out}</p>
            <p class="text-[#023e7d]/50">Nights</p><p class="font-semibold text-[#023e7d]">${r.nights}</p>
            <p class="text-[#023e7d]/50">Payment</p><p class="font-semibold text-[#023e7d] capitalize">${r.payment_type}</p>
          </div>
        </div>

        <div class="rounded-2xl bg-[#1e88e5]/5 border border-[#1e88e5]/10 p-4 space-y-2">
          <h4 class="text-sm font-black text-[#1e88e5]">Billing Summary</h4>
          <div class="flex justify-between text-sm text-[#023e7d]"><span>Subtotal</span><span>₱${Number(r.subtotal).toLocaleString()}</span></div>
          <div class="flex justify-between text-sm text-emerald-600"><span>Discount</span><span>-₱${Number(r.discount).toLocaleString()}</span></div>
          <div class="flex justify-between text-sm text-amber-600"><span>Additional Charge</span><span>+₱${Number(r.additional_charge).toLocaleString()}</span></div>
          <div class="border-t border-[#1e88e5]/10 pt-2 flex justify-between text-base font-black text-[#023e7d]"><span>Total</span><span>₱${Number(r.total_bill).toLocaleString()}</span></div>
        </div>

        <p class="text-xs text-[#023e7d]/40 text-center">Created: ${r.created_at}</p>
      </div>
    `;
  });
}

function closeDetailModal() {
  const modal = document.getElementById('reservation-detail-modal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function deleteReservation(id) {
  if (!confirm('Delete this reservation? This action cannot be undone.')) return;
  apiPost('delete_reservation', { id }).then(res => {
    if (res.success) {
      showToast(res.message);
      loadReservations();
    }
  });
}

// ─── HTML ESCAPING ──────────────────────────────────────

function escHtml(str) {
  if (!str) return '';
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

// ─── INIT ───────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', function () {
  if (CURRENT_TAB === 'dashboard') loadDashboard();
  if (CURRENT_TAB === 'rooms') loadRooms();
  if (CURRENT_TAB === 'reservations') loadReservations();

  // Close modals on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeRoomModal();
      closeReservationModal();
      closeDetailModal();
    }
  });
});
