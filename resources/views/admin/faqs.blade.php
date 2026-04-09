@extends('admin.layout')

@section('content')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  .faq-wrap {
    font-family: Arial, sans-serif;
    padding: 24px 20px;
    max-width: 1100px;
    margin: 0 auto
  }

  .faq-wrap * {
    font-family: Arial, sans-serif
  }

  :root {
    --faq-red: #C0392B;
    --faq-red-hover: #a93226;
    --faq-red-light: #FDECEA;
    --faq-white: #fff;
    --faq-gray-50: #F9F9F9;
    --faq-gray-100: #F1F1F1;
    --faq-gray-200: #E0E0E0;
    --faq-gray-400: #9E9E9E;
    --faq-gray-600: #555;
    --faq-gray-800: #222;
    --faq-radius: 8px;
    --faq-radius-sm: 5px;
  }

  /* Toolbar */
  .faq-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 18px
  }

  .faq-search-wrap {
    position: relative;
    flex: 1;
    min-width: 180px
  }

  .faq-search-wrap svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--faq-gray-400);
    width: 16px;
    height: 16px;
    pointer-events: none
  }

  .faq-search-wrap input {
    width: 100%;
    padding: 9px 12px 9px 34px;
    border: 1.5px solid var(--faq-gray-200);
    border-radius: var(--faq-radius);
    font-family: Arial;
    font-size: 13px;
    outline: none;
    transition: border .2s;
    background: var(--faq-white)
  }

  .faq-search-wrap input:focus {
    border-color: var(--faq-red)
  }

  /* Buttons */
  .faq-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: var(--faq-radius);
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: all .15s;
    text-decoration: none
  }

  .faq-btn-outline {
    background: var(--faq-white);
    border-color: var(--faq-gray-200);
    color: var(--faq-gray-600)
  }

  .faq-btn-outline:hover {
    border-color: var(--faq-red);
    color: var(--faq-red)
  }

  .faq-btn-red {
    background: var(--faq-red);
    color: #fff;
    border-color: var(--faq-red)
  }

  .faq-btn-red:hover {
    background: var(--faq-red-hover)
  }

  /* Filter bar */
  .faq-filter-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap
  }

  .faq-filter-btn {
    padding: 6px 14px;
    border-radius: 20px;
    font-family: Arial;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid var(--faq-gray-200);
    background: var(--faq-white);
    color: var(--faq-gray-600);
    transition: all .15s
  }

  .faq-filter-btn.active {
    background: var(--faq-red);
    border-color: var(--faq-red);
    color: #fff
  }

  .faq-filter-btn:hover:not(.active) {
    border-color: var(--faq-red);
    color: var(--faq-red)
  }

  /* Table */
  .faq-table-wrap {
    background: var(--faq-white);
    border: 1px solid var(--faq-gray-200);
    border-radius: var(--faq-radius);
    overflow: hidden
  }

  .faq-table-wrap table {
    width: 100%;
    border-collapse: collapse
  }

  .faq-table-wrap thead tr {
    background: var(--faq-gray-50);
    border-bottom: 1.5px solid var(--faq-gray-200)
  }

  .faq-table-wrap th {
    padding: 11px 14px;
    text-align: left;
    font-family: Arial;
    font-size: 12px;
    font-weight: 700;
    color: var(--faq-gray-600);
    letter-spacing: .04em;
    text-transform: uppercase
  }

  .faq-table-wrap tbody tr {
    border-bottom: 1px solid var(--faq-gray-100);
    cursor: pointer;
    transition: background .12s
  }

  .faq-table-wrap tbody tr:hover {
    background: var(--faq-red-light)
  }

  .faq-table-wrap tbody tr:last-child {
    border-bottom: none
  }

  .faq-table-wrap td {
    padding: 12px 14px;
    font-family: Arial;
    font-size: 13px;
    color: var(--faq-gray-800);
    vertical-align: top
  }

  .faq-q-cell {
    max-width: 220px
  }

  .faq-q-text {
    font-weight: 600;
    color: var(--faq-gray-800);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px
  }

  .faq-q-sub {
    font-size: 11px;
    color: var(--faq-gray-400);
    margin-top: 2px
  }

  .faq-a-cell {
    max-width: 280px
  }

  .faq-a-text {
    color: var(--faq-gray-600);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 260px;
    font-style: italic
  }

  .faq-a-empty {
    color: var(--faq-gray-400);
    font-style: italic
  }

  .faq-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700
  }

  .faq-badge-answered {
    background: #EAF7F0;
    color: #1A7A4A
  }

  .faq-badge-pending {
    background: var(--faq-red-light);
    color: var(--faq-red)
  }

  .faq-badge-archived {
    background: var(--faq-gray-100);
    color: var(--faq-gray-600)
  }

  .faq-actions-cell {
    text-align: right;
    white-space: nowrap
  }

  .faq-action-icon {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px 6px;
    border-radius: var(--faq-radius-sm);
    color: var(--faq-gray-400);
    transition: all .15s
  }

  .faq-action-icon:hover {
    color: var(--faq-red);
    background: var(--faq-red-light)
  }

  .faq-action-icon-del:hover {
    color: var(--faq-red);
    background: var(--faq-red-light)
  }

  .faq-empty-row td {
    padding: 32px;
    text-align: center;
    color: var(--faq-gray-400);
    font-style: italic;
    font-size: 13px
  }

  /* Pagination */
  .faq-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 16px;
    flex-wrap: wrap;
    gap: 8px
  }

  .faq-page-info {
    font-family: Arial;
    font-size: 12px;
    color: var(--faq-gray-400)
  }

  .faq-page-btns {
    display: flex;
    gap: 4px
  }

  .faq-page-btn {
    width: 30px;
    height: 30px;
    border: 1.5px solid var(--faq-gray-200);
    background: var(--faq-white);
    border-radius: var(--faq-radius-sm);
    font-family: Arial;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    color: var(--faq-gray-600);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .15s
  }

  .faq-page-btn:hover:not(.active):not(:disabled) {
    border-color: var(--faq-red);
    color: var(--faq-red)
  }

  .faq-page-btn.active {
    background: var(--faq-red);
    border-color: var(--faq-red);
    color: #fff
  }

  .faq-page-btn:disabled {
    opacity: .3;
    cursor: not-allowed
  }

  /* Modals */
  .faq-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .45);
    z-index: 9000;
    align-items: center;
    justify-content: center;
    padding: 16px
  }

  .faq-overlay.open {
    display: flex
  }

  .faq-modal {
    background: var(--faq-white);
    border-radius: 12px;
    width: 100%;
    max-width: 540px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 8px 40px rgba(0, 0, 0, .18)
  }

  .faq-modal-lg {
    max-width: 700px
  }

  .faq-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px 14px;
    border-bottom: 1px solid var(--faq-gray-200);
    position: sticky;
    top: 0;
    background: var(--faq-white);
    z-index: 1
  }

  .faq-modal-title {
    font-family: Arial;
    font-size: 16px;
    font-weight: 700;
    color: var(--faq-gray-800)
  }

  .faq-modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--faq-gray-400);
    padding: 4px;
    border-radius: var(--faq-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .15s
  }

  .faq-modal-close:hover {
    color: var(--faq-red);
    background: var(--faq-red-light)
  }

  .faq-modal-body {
    padding: 20px
  }

  .faq-modal-footer {
    padding: 14px 20px;
    border-top: 1px solid var(--faq-gray-200);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    position: sticky;
    bottom: 0;
    background: var(--faq-white)
  }

  .faq-field-label {
    font-family: Arial;
    font-size: 12px;
    font-weight: 700;
    color: var(--faq-gray-600);
    margin-bottom: 5px
  }

  .faq-field-value {
    font-family: Arial;
    font-size: 14px;
    color: var(--faq-gray-800);
    margin-bottom: 14px;
    line-height: 1.5
  }

  .faq-inp {
    width: 100%;
    padding: 9px 12px;
    border: 1.5px solid var(--faq-gray-200);
    border-radius: var(--faq-radius);
    font-family: Arial;
    font-size: 13px;
    outline: none;
    transition: border .2s;
    resize: vertical
  }

  .faq-inp:focus {
    border-color: var(--faq-red)
  }

  textarea.faq-inp {
    min-height: 90px
  }

  .faq-meta-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    flex-wrap: wrap
  }

  .faq-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--faq-gray-600)
  }

  .faq-divider {
    border: none;
    border-top: 1px solid var(--faq-gray-100);
    margin: 14px 0
  }

  .faq-action-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 4px
  }

  .faq-action-card {
    border: 1.5px solid var(--faq-gray-200);
    border-radius: var(--faq-radius);
    padding: 12px 14px;
    cursor: pointer;
    transition: all .15s;
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--faq-white)
  }

  .faq-action-card:hover {
    border-color: var(--faq-red);
    background: var(--faq-red-light)
  }

  .faq-action-card-text {
    font-family: Arial;
    font-size: 13px;
    font-weight: 600;
    color: var(--faq-gray-800)
  }

  .faq-action-card-sub {
    font-family: Arial;
    font-size: 11px;
    color: var(--faq-gray-400)
  }

  .faq-action-card svg {
    flex-shrink: 0;
    color: var(--faq-red)
  }

  /* Archived list */
  .faq-arch-item {
    border: 1px solid var(--faq-gray-100);
    border-radius: var(--faq-radius);
    padding: 12px 14px;
    margin-bottom: 10px
  }

  .faq-arch-q {
    font-weight: 700;
    font-size: 13px;
    color: var(--faq-gray-800);
    margin-bottom: 3px
  }

  .faq-arch-a {
    font-size: 12px;
    color: var(--faq-gray-600);
    margin-bottom: 8px;
    font-style: italic
  }

  .faq-arch-actions {
    display: flex;
    gap: 6px
  }

  /* Floating guide */
  .faq-guide {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 8999
  }

  .faq-guide-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--faq-red);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(192, 57, 43, .35);
    transition: all .15s
  }

  .faq-guide-btn:hover {
    background: var(--faq-red-hover);
    transform: scale(1.08)
  }

  .faq-guide-popup {
    display: none;
    position: absolute;
    bottom: 50px;
    right: 0;
    background: var(--faq-white);
    border: 1px solid var(--faq-gray-200);
    border-radius: var(--faq-radius);
    padding: 14px 16px;
    width: 240px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, .12)
  }

  .faq-guide-popup.open {
    display: block
  }

  .faq-guide-popup h4 {
    font-family: Arial;
    font-size: 13px;
    font-weight: 700;
    color: var(--faq-gray-800);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px
  }

  .faq-guide-popup ul {
    list-style: none;
    padding: 0
  }

  .faq-guide-popup li {
    font-family: Arial;
    font-size: 12px;
    color: var(--faq-gray-600);
    padding: 4px 0;
    border-bottom: 1px solid var(--faq-gray-100);
    display: flex;
    align-items: flex-start;
    gap: 6px;
    line-height: 1.4
  }

  .faq-guide-popup li:last-child {
    border-bottom: none
  }

  .faq-guide-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--faq-red);
    flex-shrink: 0;
    margin-top: 4px
  }

  /* Responsive */
  @media(max-width:640px) {
    .faq-wrap {
      padding: 16px 12px
    }

    .faq-q-cell,
    .faq-a-cell {
      max-width: 120px
    }

    .faq-q-text,
    .faq-a-text {
      max-width: 100px
    }

    .faq-table-wrap th:nth-child(3),
    .faq-table-wrap td:nth-child(3) {
      display: none
    }

    .faq-table-wrap th:nth-child(2),
    .faq-table-wrap td:nth-child(2) {
      display: none
    }

    .faq-action-grid {
      grid-template-columns: 1fr
    }

    .faq-toolbar {
      gap: 6px
    }

    .faq-modal {
      max-width: 100%
    }

    .faq-modal-lg {
      max-width: 100%
    }

    .faq-guide {
      bottom: 12px;
      right: 12px
    }
  }
</style>

<div class="faq-wrap">

  {{-- Toolbar --}}
  <div class="faq-toolbar">
    <div class="faq-search-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.35-4.35" />
      </svg>
      <input type="text" id="faqSearchInput" placeholder="Search FAQs..." oninput="faqApplyFilters()">
    </div>
    <button class="faq-btn faq-btn-outline" onclick="faqOpenModal('faqArchiveModal')">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="21 8 21 21 3 21 3 8" />
        <rect x="1" y="3" width="22" height="5" />
        <line x1="10" y1="12" x2="14" y2="12" />
      </svg>
      Archived FAQs
    </button>
  </div>

  {{-- Filter Bar --}}
  <div class="faq-filter-bar">
    <button class="faq-filter-btn active" data-filter="all" onclick="faqSetFilter('all',this)">All FAQs</button>
    <button class="faq-filter-btn" data-filter="answered" onclick="faqSetFilter('answered',this)">&#10003; Answered</button>
    <button class="faq-filter-btn" data-filter="pending" onclick="faqSetFilter('pending',this)">Pending</button>
    <span style="margin-left:auto;font-family:Arial;font-size:12px;color:var(--faq-gray-400)" id="faqCountLabel"></span>
  </div>

  {{-- Table --}}
  <div class="faq-table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Question</th>
          <th>Answer</th>
          <th>Status</th>
          <th style="text-align:right">Actions</th>
        </tr>
      </thead>
      <tbody id="faqTbody"></tbody>
    </table>
  </div>

  {{-- Pagination --}}
  <div class="faq-pagination">
    <span class="faq-page-info" id="faqPageInfo"></span>
    <div class="faq-page-btns" id="faqPageBtns"></div>
  </div>

</div>{{-- end .faq-wrap --}}


{{-- ===== DETAIL MODAL ===== --}}
<div class="faq-overlay" id="faqDetailModal">
  <div class="faq-modal" role="dialog" aria-modal="true" aria-labelledby="faqDetailTitle">
    <div class="faq-modal-header">
      <span class="faq-modal-title" id="faqDetailTitle">FAQ Details</span>
      <button class="faq-modal-close" onclick="faqCloseModal('faqDetailModal')" aria-label="Close">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="faq-modal-body">
      <div class="faq-field-label">Question</div>
      <div class="faq-field-value" id="faqDetailQ"></div>
      <div class="faq-field-label">Answer</div>
      <div class="faq-field-value" id="faqDetailA"></div>
      <div class="faq-meta-row">
        <div class="faq-meta-item">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
          <span id="faqDetailUser"></span>
        </div>
        <div class="faq-meta-item">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
          <span id="faqDetailDate"></span>
        </div>
        <span id="faqDetailBadge"></span>
      </div>
      <hr class="faq-divider">
      <div style="font-family:Arial;font-size:12px;font-weight:700;color:var(--faq-gray-600);margin-bottom:10px">Actions</div>
      <div class="faq-action-grid">
        <div class="faq-action-card" id="faqActionAnswer" onclick="faqOpenAnswerModal()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
          </svg>
          <div>
            <div class="faq-action-card-text">Answer</div>
            <div class="faq-action-card-sub">Provide a response</div>
          </div>
        </div>
        <div class="faq-action-card" onclick="faqOpenEditModal()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
          </svg>
          <div>
            <div class="faq-action-card-text">Edit Answer</div>
            <div class="faq-action-card-sub">Modify existing answer</div>
          </div>
        </div>
        <div class="faq-action-card" onclick="faqArchiveCurrent()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="21 8 21 21 3 21 3 8" />
            <rect x="1" y="3" width="22" height="5" />
            <line x1="10" y1="12" x2="14" y2="12" />
          </svg>
          <div>
            <div class="faq-action-card-text">Archive</div>
            <div class="faq-action-card-sub">Remove from active list</div>
          </div>
        </div>
        <div class="faq-action-card" onclick="faqDeleteCurrent()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2">
            <polyline points="3 6 5 6 21 6" />
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
            <path d="M10 11v6M14 11v6" />
            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
          </svg>
          <div>
            <div class="faq-action-card-text" style="color:var(--faq-red)">Delete</div>
            <div class="faq-action-card-sub">Permanently remove</div>
          </div>
        </div>
      </div>
    </div>
    <div class="faq-modal-footer">
      <button class="faq-btn faq-btn-outline" onclick="faqCloseModal('faqDetailModal')">Close</button>
    </div>
  </div>
</div>


{{-- ===== ANSWER MODAL ===== --}}
<div class="faq-overlay" id="faqAnswerModal">
  <div class="faq-modal" role="dialog" aria-modal="true">
    <div class="faq-modal-header">
      <span class="faq-modal-title">Answer Question</span>
      <button class="faq-modal-close" onclick="faqCloseModal('faqAnswerModal')" aria-label="Close">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="faq-modal-body">
      <div class="faq-field-label">Question</div>
      <div class="faq-field-value" id="faqAnswerQ"
        style="background:var(--faq-gray-50);padding:10px;border-radius:var(--faq-radius-sm)"></div>
      <div style="margin-top:14px">
        <div class="faq-field-label" style="margin-bottom:6px">Your Answer</div>
        <textarea class="faq-inp" id="faqAnswerText" placeholder="Type your answer here..."></textarea>
      </div>
    </div>
    <div class="faq-modal-footer">
      <button class="faq-btn faq-btn-outline" onclick="faqCloseModal('faqAnswerModal')">Cancel</button>
      <button class="faq-btn faq-btn-red" onclick="faqSubmitAnswer()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="20 6 9 17 4 12" />
        </svg>
        Submit Answer
      </button>
    </div>
  </div>
</div>


{{-- ===== EDIT MODAL ===== --}}
<div class="faq-overlay" id="faqEditModal">
  <div class="faq-modal" role="dialog" aria-modal="true">
    <div class="faq-modal-header">
      <span class="faq-modal-title">Edit Answer</span>
      <button class="faq-modal-close" onclick="faqCloseModal('faqEditModal')" aria-label="Close">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="faq-modal-body">
      <div class="faq-field-label">Question</div>
      <div class="faq-field-value" id="faqEditQ"
        style="background:var(--faq-gray-50);padding:10px;border-radius:var(--faq-radius-sm)"></div>
      <div style="margin-top:14px">
        <div class="faq-field-label" style="margin-bottom:6px">Edit Answer</div>
        <textarea class="faq-inp" id="faqEditText" placeholder="Edit the answer..."></textarea>
      </div>
    </div>
    <div class="faq-modal-footer">
      <button class="faq-btn faq-btn-outline" onclick="faqCloseModal('faqEditModal')">Cancel</button>
      <button class="faq-btn faq-btn-red" onclick="faqSaveEdit()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
          <polyline points="17 21 17 13 7 13 7 21" />
          <polyline points="7 3 7 8 15 8" />
        </svg>
        Save Changes
      </button>
    </div>
  </div>
</div>


{{-- ===== ARCHIVED MODAL ===== --}}
<div class="faq-overlay" id="faqArchiveModal">
  <div class="faq-modal faq-modal-lg" role="dialog" aria-modal="true">
    <div class="faq-modal-header">
      <span class="faq-modal-title">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          style="vertical-align:-3px;margin-right:5px">
          <polyline points="21 8 21 21 3 21 3 8" />
          <rect x="1" y="3" width="22" height="5" />
          <line x1="10" y1="12" x2="14" y2="12" />
        </svg>
        Archived FAQs
      </span>
      <button class="faq-modal-close" onclick="faqCloseModal('faqArchiveModal')" aria-label="Close">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="faq-modal-body" id="faqArchivedList" style="min-height:80px"></div>
    <div class="faq-modal-footer">
      <button class="faq-btn faq-btn-outline" onclick="faqCloseModal('faqArchiveModal')">Close</button>
    </div>
  </div>
</div>


{{-- ===== FLOATING GUIDE ===== --}}
<div class="faq-guide">
  <div class="faq-guide-popup" id="faqGuidePopup">
    <h4>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--faq-red)" stroke-width="2">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="8" x2="12" y2="12" />
        <line x1="12" y1="16" x2="12.01" y2="16" />
      </svg>
      How to use
    </h4>
    <ul>
      <li><span class="faq-guide-dot"></span>Click any row to view full details &amp; actions</li>
      <li><span class="faq-guide-dot"></span>Use filter buttons to show Answered or Pending FAQs</li>
      <li><span class="faq-guide-dot"></span>Search bar filters questions &amp; answers live</li>
      <li><span class="faq-guide-dot"></span>Use row icons to quickly edit or delete</li>
      <li><span class="faq-guide-dot"></span>Archived FAQs are hidden from active list</li>
      <li><span class="faq-guide-dot"></span>Navigate pages with pagination below the table</li>
    </ul>
  </div>
  <button class="faq-guide-btn" onclick="faqToggleGuide()" title="Help guide">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5">
      <circle cx="12" cy="12" r="10" />
      <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
      <line x1="12" y1="17" x2="12.01" y2="17" />
    </svg>
  </button>
</div>


<script>
  /*
   * FAQ Manager — JavaScript
   * Replace the `faqData` array below with real data from your Laravel controller/API.
   * e.g., const faqData = ;
   * Each item should have: id, question, answer, status ('answered'|'pending'),
   * user (who asked), answeredBy (admin who answered), date, archived (bool)
   */
  const FAQ_PER_PAGE = 6;

  // ── Sample data (replace with  from your controller) ──────────────
  let faqData = [{
      id: 1,
      question: "How do I reset my password?",
      answer: "Click the 'Forgot Password' link on the login page and follow the instructions sent to your email.",
      status: "answered",
      user: "Admin",
      answeredBy: "Maria Santos",
      date: "2025-04-01",
      archived: false
    },
    {
      id: 2,
      question: "How can I update my profile picture?",
      answer: "Go to Settings > Profile and click the camera icon on your avatar to upload a new photo.",
      status: "answered",
      user: "Juan dela Cruz",
      answeredBy: "Maria Santos",
      date: "2025-04-02",
      archived: false
    },
    {
      id: 3,
      question: "What payment methods are accepted?",
      answer: "",
      status: "pending",
      user: "Ana Reyes",
      answeredBy: "",
      date: "2025-04-03",
      archived: false
    },
    {
      id: 4,
      question: "Is there a mobile app available?",
      answer: "Yes! Our mobile app is available on both iOS and Android.",
      status: "answered",
      user: "Carlo Bautista",
      answeredBy: "Jose Rizal",
      date: "2025-04-03",
      archived: false
    },
    {
      id: 5,
      question: "How do I cancel my subscription?",
      answer: "",
      status: "pending",
      user: "Liza Soberano",
      answeredBy: "",
      date: "2025-04-04",
      archived: false
    },
    {
      id: 6,
      question: "Can I have multiple accounts?",
      answer: "Each person is allowed one account per email address. Contact support if you need help.",
      status: "answered",
      user: "Mark Garcia",
      answeredBy: "Maria Santos",
      date: "2025-04-04",
      archived: false
    },
    {
      id: 7,
      question: "How long does shipping take?",
      answer: "",
      status: "pending",
      user: "Rosa Mendoza",
      answeredBy: "",
      date: "2025-04-05",
      archived: false
    },
    {
      id: 8,
      question: "Do you offer student discounts?",
      answer: "Yes, we offer a 20% discount for verified students.",
      status: "answered",
      user: "Pedro Penduko",
      answeredBy: "Jose Rizal",
      date: "2025-04-05",
      archived: false
    },
    {
      id: 9,
      question: "How do I contact customer support?",
      answer: "You can reach us via the Help Center chat or email support@site.com.",
      status: "answered",
      user: "Nina Cruz",
      answeredBy: "Maria Santos",
      date: "2025-04-06",
      archived: false
    },
    {
      id: 10,
      question: "Why is my account locked?",
      answer: "",
      status: "pending",
      user: "Raffy Tulfo",
      answeredBy: "",
      date: "2025-04-06",
      archived: false
    }
  ];

  let faqCurrentFilter = 'all';
  let faqCurrentPage = 1;
  let faqCurrentId = null;
  let faqSearchTerm = '';

  // ── Helpers ───────────────────────────────────────────────────────────────────
  function faqEsc(s) {
    return (s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  function faqGet(id) {
    return faqData.find(f => f.id === id);
  }

  // ── Filter & search ───────────────────────────────────────────────────────────
  function faqFiltered() {
    return faqData.filter(f => {
      if (f.archived) return false;
      if (faqCurrentFilter === 'answered' && f.status !== 'answered') return false;
      if (faqCurrentFilter === 'pending' && f.status !== 'pending') return false;
      if (faqSearchTerm) {
        const s = faqSearchTerm.toLowerCase();
        if (!f.question.toLowerCase().includes(s) && !f.answer.toLowerCase().includes(s)) return false;
      }
      return true;
    });
  }

  function faqSetFilter(filter, el) {
    faqCurrentFilter = filter;
    faqCurrentPage = 1;
    document.querySelectorAll('.faq-filter-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    faqRender();
  }

  function faqApplyFilters() {
    faqSearchTerm = document.getElementById('faqSearchInput').value;
    faqCurrentPage = 1;
    faqRender();
  }

  // ── Render table ──────────────────────────────────────────────────────────────
  function faqRender() {
    const data = faqFiltered();
    const total = data.length;
    const pages = Math.max(1, Math.ceil(total / FAQ_PER_PAGE));

    if (faqCurrentPage > pages) faqCurrentPage = 1;

    const start = (faqCurrentPage - 1) * FAQ_PER_PAGE;
    const slice = data.slice(start, start + FAQ_PER_PAGE);

    const tbody = document.getElementById('faqTbody');

    if (!slice.length) {
      tbody.innerHTML = '<tr class="faq-empty-row"><td colspan="5">No FAQs found.</td></tr>';
    } else {
      tbody.innerHTML = slice.map((f, i) => `
      <tr onclick="faqOpenDetail(${f.id})">
        <td style="color:var(--faq-gray-400);font-size:12px">${start + i + 1}</td>
        <td class="faq-q-cell">
          <div class="faq-q-text" title="${faqEsc(f.question)}">${faqEsc(f.question)}</div>
          <div class="faq-q-sub">${faqEsc(f.user)}</div>
        </td>
        <td class="faq-a-cell">
          <div class="${f.answer ? 'faq-a-text' : 'faq-a-empty'}" title="${faqEsc(f.answer)}">
            ${f.answer ? faqEsc(f.answer) : 'No answer yet'}
          </div>
        </td>
        <td>
          <span class="faq-badge ${f.status === 'answered' ? 'faq-badge-answered' : 'faq-badge-pending'}">
            ${f.status === 'answered' ? '&#10003; Answered' : '&#9679; Pending'}
          </span>
        </td>
        <td class="faq-actions-cell" onclick="event.stopPropagation()">
          <button class="faq-action-icon" title="Edit answer" onclick="event.stopPropagation();faqQuickEdit(${f.id})">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
          </button>
          <button class="faq-action-icon" title="Archive" onclick="event.stopPropagation();faqArchiveFaq(${f.id})">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/>
              <line x1="10" y1="12" x2="14" y2="12"/>
            </svg>
          </button>
          <button class="faq-action-icon faq-action-icon-del" title="Delete" style="color:var(--faq-red)"
            onclick="event.stopPropagation();faqDeleteFaq(${f.id})">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="3 6 5 6 21 6"/>
              <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
            </svg>
          </button>
        </td>
      </tr>`).join('');
    }

    document.getElementById('faqCountLabel').textContent = `${total} result${total !== 1 ? 's' : ''}`;
    document.getElementById('faqPageInfo').textContent =
      `Showing ${total === 0 ? 0 : start + 1}–${Math.min(start + FAQ_PER_PAGE, total)} of ${total}`;

    faqRenderPages(pages);
  }

  // ── Pagination ────────────────────────────────────────────────────────────────
  function faqRenderPages(pages) {
    const c = document.getElementById('faqPageBtns');
    let h = '';

    h += `<button class="faq-page-btn" onclick="faqGoPage(${faqCurrentPage - 1})"
    ${faqCurrentPage === 1 ? 'disabled' : ''}>
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <polyline points="15 18 9 12 15 6"/>
    </svg></button>`;

    for (let p = 1; p <= pages; p++) {
      if (pages > 5 && p > 2 && p < pages - 1 && Math.abs(p - faqCurrentPage) > 1) {
        if (p === 3 || p === pages - 2)
          h += `<button class="faq-page-btn" disabled style="border:none;cursor:default">…</button>`;
        continue;
      }
      h += `<button class="faq-page-btn ${p === faqCurrentPage ? 'active' : ''}"
      onclick="faqGoPage(${p})">${p}</button>`;
    }

    h += `<button class="faq-page-btn" onclick="faqGoPage(${faqCurrentPage + 1})"
    ${faqCurrentPage === pages ? 'disabled' : ''}>
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <polyline points="9 18 15 12 9 6"/>
    </svg></button>`;

    c.innerHTML = h;
  }

  function faqGoPage(p) {
    const pages = Math.ceil(faqFiltered().length / FAQ_PER_PAGE);
    if (p < 1 || p > pages) return;
    faqCurrentPage = p;
    faqRender();
  }

  // ── Detail modal ──────────────────────────────────────────────────────────────
  function faqOpenDetail(id) {
    faqCurrentId = id;
    const f = faqGet(id);
    document.getElementById('faqDetailTitle').textContent = 'FAQ #' + f.id;
    document.getElementById('faqDetailQ').textContent = f.question;
    document.getElementById('faqDetailA').textContent = f.answer || 'No answer provided yet.';
    document.getElementById('faqDetailUser').textContent =
      'Asked by: ' + f.user + (f.answeredBy ? ' · Answered by: ' + f.answeredBy : '');
    document.getElementById('faqDetailDate').textContent = f.date;
    document.getElementById('faqDetailBadge').innerHTML =
      `<span class="faq-badge ${f.status === 'answered' ? 'faq-badge-answered' : 'faq-badge-pending'}">
      ${f.status === 'answered' ? '&#10003; Answered' : '&#9679; Pending'}
    </span>`;
    document.getElementById('faqActionAnswer').style.opacity = f.status === 'answered' ? '.45' : '1';
    document.getElementById('faqActionAnswer').style.pointerEvents = f.status === 'answered' ? 'none' : 'auto';
    faqOpenModal('faqDetailModal');
  }

  // ── Answer modal ──────────────────────────────────────────────────────────────
  function faqOpenAnswerModal() {
    const f = faqGet(faqCurrentId);
    if (!f || f.status === 'answered') return;
    document.getElementById('faqAnswerQ').textContent = f.question;
    document.getElementById('faqAnswerText').value = '';
    faqCloseModal('faqDetailModal');
    faqOpenModal('faqAnswerModal');
  }

  function faqSubmitAnswer() {
    const val = document.getElementById('faqAnswerText').value.trim();
    if (!val) return;
    const f = faqGet(faqCurrentId);
    f.answer = val;
    f.status = 'answered';
    f.answeredBy = 'Admin'; // replace with {{ Auth::user()->name }} if needed
    faqCloseModal('faqAnswerModal');
    faqRender();
  }

  // ── Edit modal ────────────────────────────────────────────────────────────────
  function faqOpenEditModal() {
    const f = faqGet(faqCurrentId);
    if (!f) return;
    document.getElementById('faqEditQ').textContent = f.question;
    document.getElementById('faqEditText').value = f.answer || '';
    faqCloseModal('faqDetailModal');
    faqOpenModal('faqEditModal');
  }

  function faqQuickEdit(id) {
    faqCurrentId = id;
    faqOpenEditModal();
  }

  function faqSaveEdit() {
    const val = document.getElementById('faqEditText').value.trim();
    if (!val) return;
    const f = faqGet(faqCurrentId);
    f.answer = val;
    f.status = 'answered';
    f.answeredBy = f.answeredBy || 'Admin';
    faqCloseModal('faqEditModal');
    faqRender();
  }

  // ── Archive & delete ──────────────────────────────────────────────────────────
  function faqArchiveCurrent() {
    faqArchiveFaq(faqCurrentId);
    faqCloseModal('faqDetailModal');
  }

  function faqArchiveFaq(id) {
    const f = faqGet(id);
    if (f) f.archived = true;
    faqRender();
  }

  function faqDeleteCurrent() {
    faqDeleteFaq(faqCurrentId);
    faqCloseModal('faqDetailModal');
  }

  function faqDeleteFaq(id) {
    faqData = faqData.filter(f => f.id !== id);
    faqRender();
  }

  // ── Archived modal ────────────────────────────────────────────────────────────
  function faqRenderArchived() {
    const arch = faqData.filter(f => f.archived);
    const c = document.getElementById('faqArchivedList');
    if (!arch.length) {
      c.innerHTML = '<div style="text-align:center;color:var(--faq-gray-400);font-size:13px;padding:24px">No archived FAQs.</div>';
      return;
    }
    c.innerHTML = arch.map(f => `
    <div class="faq-arch-item">
      <div class="faq-arch-q">${faqEsc(f.question)}</div>
      <div class="faq-arch-a">${f.answer ? faqEsc(f.answer) : 'No answer'}</div>
      <div class="faq-arch-actions">
        <button class="faq-btn faq-btn-outline" style="font-size:11px;padding:5px 10px" onclick="faqRestoreFaq(${f.id})">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="1 4 1 10 7 10"/>
            <path d="M3.51 15a9 9 0 1 0 .49-3.51"/>
          </svg>
          Restore
        </button>
        <button class="faq-btn" style="font-size:11px;padding:5px 10px;background:var(--faq-red-light);color:var(--faq-red);border-color:transparent"
          onclick="faqPermanentDelete(${f.id})">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          </svg>
          Delete
        </button>
      </div>
    </div>`).join('');
  }

  function faqRestoreFaq(id) {
    const f = faqGet(id);
    if (f) f.archived = false;
    faqRenderArchived();
    faqRender();
  }

  function faqPermanentDelete(id) {
    faqData = faqData.filter(f => f.id !== id);
    faqRenderArchived();
    faqRender();
  }

  // ── Modal helpers ─────────────────────────────────────────────────────────────
  function faqOpenModal(id) {
    if (id === 'faqArchiveModal') faqRenderArchived();
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function faqCloseModal(id) {
    document.getElementById(id).classList.remove('open');
    const anyOpen = document.querySelector('.faq-overlay.open');
    if (!anyOpen) document.body.style.overflow = '';
  }

  // Close on backdrop click
  document.querySelectorAll('.faq-overlay').forEach(o => {
    o.addEventListener('click', function(e) {
      if (e.target === this) faqCloseModal(this.id);
    });
  });

  // Close on Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const open = document.querySelector('.faq-overlay.open');
      if (open) faqCloseModal(open.id);
    }
  });

  // ── Guide toggle ──────────────────────────────────────────────────────────────
  function faqToggleGuide() {
    document.getElementById('faqGuidePopup').classList.toggle('open');
  }

  // ── Init ──────────────────────────────────────────────────────────────────────
  faqRender();
</script>

@endsection