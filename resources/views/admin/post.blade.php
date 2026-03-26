@extends('admin.layout')
@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

  .cmm * {
    box-sizing: border-box;
  }

  .cmm {
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 0;
    background: #f4f6f9;
    min-height: 100%;
  }

  /* ── HEADER ── */
  .cmm-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
  }

  .cmm-header h1 {
    font-size: 1.3rem;
    font-weight: 800;
    color: #1a202c;
    margin: 0 0 3px;
    letter-spacing: -0.3px;
  }

  .cmm-header p {
    font-size: 0.79rem;
    color: #718096;
    margin: 0;
  }

  .cmm-online {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.73rem;
    font-weight: 600;
    color: #276749;
    background: #c6f6d5;
    border-radius: 99px;
    padding: 5px 12px;
    border: 1px solid #9ae6b4;
  }

  .cmm-online .dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #38a169;
    animation: blink 2s ease-in-out infinite;
  }

  @keyframes blink {

    0%,
    100% {
      opacity: 1
    }

    50% {
      opacity: .25
    }
  }

  /* ── STAT STRIP ── */
  .cmm-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
  }

  .cmm-sc {
    background: #fff;
    border-radius: 11px;
    padding: 16px 18px;
    border: 1px solid #e8edf3;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: center;
    gap: 13px;
    position: relative;
    overflow: hidden;
  }

  .cmm-sc::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    border-radius: 11px 0 0 11px;
  }

  .cmm-sc.g::before {
    background: #38a169;
  }

  .cmm-sc.b::before {
    background: #3182ce;
  }

  .cmm-sc.o::before {
    background: #dd6b20;
  }

  .cmm-sc.r::before {
    background: #e53e3e;
  }

  .cmm-sc-ico {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cmm-sc.g .cmm-sc-ico {
    background: #f0fff4;
    color: #38a169;
  }

  .cmm-sc.b .cmm-sc-ico {
    background: #ebf8ff;
    color: #3182ce;
  }

  .cmm-sc.o .cmm-sc-ico {
    background: #fffaf0;
    color: #dd6b20;
  }

  .cmm-sc.r .cmm-sc-ico {
    background: #fff5f5;
    color: #e53e3e;
  }

  .cmm-sc-ico svg {
    width: 18px;
    height: 18px;
  }

  .cmm-sc-lbl {
    font-size: 0.65rem;
    font-weight: 600;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: .07em;
    margin-bottom: 1px;
  }

  .cmm-sc-val {
    font-size: 1.65rem;
    font-weight: 800;
    color: #1a202c;
    line-height: 1;
  }

  .cmm-sc-sub {
    font-size: 0.67rem;
    color: #a0aec0;
    margin-top: 1px;
  }

  /* ── MAIN GRID ── */
  .cmm-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 20px;
    align-items: start;
  }

  /* ── CARD ── */
  .cmm-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e8edf3;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 18px;
  }

  .cmm-card:last-child {
    margin-bottom: 0;
  }

  .cmm-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px 0;
  }

  .cmm-card-head h2 {
    font-size: 0.88rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0;
  }

  .cmm-card-head span {
    font-size: 0.71rem;
    color: #a0aec0;
  }

  /* ── SEARCH + FILTER BAR ── */
  .cmm-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px 12px;
    border-bottom: 1px solid #f0f4f8;
    flex-wrap: wrap;
  }

  .cmm-search-wrap {
    position: relative;
    flex: 1;
    min-width: 180px;
  }

  .cmm-search-wrap svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 14px;
    height: 14px;
    color: #a0aec0;
    pointer-events: none;
  }

  .cmm-search {
    width: 100%;
    padding: 7px 10px 7px 32px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.78rem;
    color: #2d3748;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fafbfc;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
  }

  .cmm-search:focus {
    border-color: #c53030;
    box-shadow: 0 0 0 3px rgba(197, 48, 48, 0.08);
    background: #fff;
  }

  .cmm-search::placeholder {
    color: #a0aec0;
  }

  .cmm-filter-select {
    padding: 7px 28px 7px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.76rem;
    color: #2d3748;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fafbfc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23a0aec0' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 8px center / 12px;
    appearance: none;
    outline: none;
    cursor: pointer;
    transition: border-color .15s;
  }

  .cmm-filter-select:focus {
    border-color: #c53030;
  }

  .cmm-results-count {
    font-size: 0.72rem;
    color: #a0aec0;
    white-space: nowrap;
    margin-left: auto;
  }

  /* ── TABS ── */
  .cmm-tabs {
    display: flex;
    gap: 0;
    padding: 0 20px;
    border-bottom: 1px solid #edf2f7;
    overflow-x: auto;
    scrollbar-width: none;
  }

  .cmm-tabs::-webkit-scrollbar {
    display: none;
  }

  .cmm-tab {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 10px 14px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #718096;
    border: none;
    background: none;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
    white-space: nowrap;
    transition: color .15s, border-color .15s;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .cmm-tab:hover {
    color: #2d3748;
  }

  .cmm-tab.active {
    color: #c53030;
    border-bottom-color: #c53030;
  }

  .cmm-tab-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
  }

  .cmm-tab-count {
    font-size: 0.62rem;
    font-weight: 700;
    padding: 1px 6px;
    border-radius: 99px;
    background: #f0f4f8;
    color: #718096;
  }

  .cmm-tab.active .cmm-tab-count {
    background: #fed7d7;
    color: #c53030;
  }

  /* ── ENTRIES ── */
  .cmm-entries-wrap {
    min-height: 200px;
  }

  .cmm-entry {
    border-bottom: 1px solid #f7fafc;
    padding: 14px 20px;
    cursor: pointer;
    transition: background .15s;
    position: relative;
  }

  .cmm-entry:last-child {
    border-bottom: none;
  }

  .cmm-entry:hover {
    background: #fafbfc;
  }

  .cmm-entry.unpublished {
    opacity: 0.55;
    background: #fffbf5;
  }

  .cmm-entry.unpublished:hover {
    background: #fff8ee;
  }

  .cmm-entry.removed {
    opacity: 0.45;
    background: #fff5f5;
  }

  .cmm-entry.removed:hover {
    background: #fff0f0;
  }

  .cmm-entry-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 7px;
  }

  .cmm-entry-author {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .cmm-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #c53030, #e53e3e);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.68rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: .03em;
  }

  .cmm-avatar.blue {
    background: linear-gradient(135deg, #3182ce, #4299e1);
  }

  .cmm-avatar.green {
    background: linear-gradient(135deg, #2f855a, #38a169);
  }

  .cmm-avatar.purple {
    background: linear-gradient(135deg, #6b46c1, #805ad5);
  }

  .cmm-avatar.teal {
    background: linear-gradient(135deg, #2c7a7b, #319795);
  }

  .cmm-avatar.pink {
    background: linear-gradient(135deg, #b83280, #d53f8c);
  }

  .cmm-entry-who strong {
    font-size: 0.78rem;
    font-weight: 700;
    color: #1a202c;
    display: block;
  }

  .cmm-entry-who span {
    font-size: 0.68rem;
    color: #a0aec0;
  }

  .cmm-entry-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 5px;
    flex-shrink: 0;
  }

  .cmm-entry-date {
    font-size: 0.67rem;
    color: #a0aec0;
    white-space: nowrap;
  }

  .cmm-entry-actions {
    display: flex;
    gap: 5px;
    align-items: center;
  }

  .cmm-badge {
    font-size: 0.61rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 99px;
    text-transform: uppercase;
    letter-spacing: .05em;
  }

  .badge-pub {
    background: #c6f6d5;
    color: #276749;
  }

  .badge-draft {
    background: #edf2f7;
    color: #718096;
  }

  .badge-review {
    background: #feebc8;
    color: #c05621;
  }

  .badge-live {
    background: #c6f6d5;
    color: #276749;
  }

  .badge-old {
    background: #feebc8;
    color: #c05621;
  }

  .badge-due {
    background: #fed7d7;
    color: #c53030;
  }

  .badge-update {
    background: #bee3f8;
    color: #2b6cb0;
  }

  .badge-unpub {
    background: #feebc8;
    color: #c05621;
  }

  .badge-removed {
    background: #fed7d7;
    color: #c53030;
  }

  /* Action buttons on entry */
  .cmm-action-btn {
    font-size: 0.63rem;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 6px;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .15s;
    border: 1px solid transparent;
    white-space: nowrap;
  }

  .cmm-action-btn:hover {
    transform: none;
  }

  .cmm-action-btn.unpublish {
    background: #fffaf0;
    color: #c05621;
    border-color: #f6ad55;
  }

  .cmm-action-btn.unpublish:hover {
    background: #feebc8;
  }

  .cmm-action-btn.remove {
    background: #fff5f5;
    color: #c53030;
    border-color: #feb2b2;
  }

  .cmm-action-btn.remove:hover {
    background: #fed7d7;
  }

  .cmm-action-btn.restore {
    background: #f0fff4;
    color: #276749;
    border-color: #9ae6b4;
  }

  .cmm-action-btn.restore:hover {
    background: #c6f6d5;
  }

  .cmm-entry-title {
    font-size: 0.82rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 4px;
    line-height: 1.35;
  }

  .cmm-entry-body {
    font-size: 0.74rem;
    color: #718096;
    line-height: 1.55;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .cmm-entry-footer {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    flex-wrap: wrap;
  }

  .cmm-entry-tag {
    font-size: 0.64rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 5px;
    background: #f0f4f8;
    color: #718096;
  }

  .cmm-status-banner {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.65rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 5px;
    margin-right: 6px;
  }

  .cmm-status-banner.unpub {
    background: #feebc8;
    color: #c05621;
  }

  .cmm-status-banner.rem {
    background: #fed7d7;
    color: #c53030;
  }

  /* image thumb */
  .cmm-img-strip {
    display: flex;
    gap: 6px;
    margin-top: 8px;
    flex-wrap: wrap;
  }

  .cmm-thumb {
    width: 52px;
    height: 42px;
    border-radius: 6px;
    background: #edf2f7;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.6rem;
    color: #a0aec0;
    font-weight: 600;
    overflow: hidden;
  }

  /* ── EMPTY STATE ── */
  .cmm-empty {
    text-align: center;
    padding: 48px 20px;
    color: #a0aec0;
  }

  .cmm-empty svg {
    width: 36px;
    height: 36px;
    margin: 0 auto 12px;
    display: block;
    color: #e2e8f0;
  }

  .cmm-empty p {
    font-size: 0.82rem;
    margin: 0;
  }

  /* ── PAGINATION ── */
  .cmm-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 20px;
    border-top: 1px solid #f0f4f8;
    flex-wrap: wrap;
    gap: 10px;
  }

  .cmm-page-info {
    font-size: 0.72rem;
    color: #a0aec0;
  }

  .cmm-page-btns {
    display: flex;
    gap: 4px;
    align-items: center;
  }

  .cmm-page-btn {
    width: 30px;
    height: 30px;
    border-radius: 7px;
    border: 1px solid #e2e8f0;
    background: #fff;
    font-size: 0.75rem;
    font-weight: 600;
    color: #718096;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .15s;
  }

  .cmm-page-btn:hover {
    background: #f0f4f8;
    border-color: #cbd5e0;
  }

  .cmm-page-btn.active {
    background: #c53030;
    border-color: #c53030;
    color: #fff;
  }

  .cmm-page-btn:disabled {
    opacity: .4;
    cursor: default;
  }

  .cmm-page-btn svg {
    width: 13px;
    height: 13px;
  }

  /* ── SIDEBAR ── */
  .cmm-page-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 20px;
    border-bottom: 1px solid #f7fafc;
    cursor: pointer;
    transition: background .15s;
  }

  .cmm-page-row:last-child {
    border-bottom: none;
  }

  .cmm-page-row:hover {
    background: #fafbfc;
  }

  .cmm-page-ico {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background: #f0f4f8;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cmm-page-ico svg {
    width: 15px;
    height: 15px;
    color: #718096;
  }

  .cmm-page-info {
    flex: 1;
    min-width: 0;
  }

  .cmm-page-name {
    font-size: 0.8rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 2px;
  }

  .cmm-page-meta {
    font-size: 0.7rem;
    color: #718096;
    line-height: 1.45;
  }

  .cmm-page-meta strong {
    color: #2d3748;
    font-weight: 600;
  }

  .cmm-page-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    flex-shrink: 0;
  }

  .cmm-page-date {
    font-size: 0.64rem;
    color: #a0aec0;
    white-space: nowrap;
  }

  /* ── PREVIEW MODAL ── */
  #cmm-modal-bg {
    position: fixed;
    inset: 0;
    background: rgba(26, 32, 44, .4);
    backdrop-filter: blur(4px);
    z-index: 99998;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s;
  }

  #cmm-modal-bg.open {
    opacity: 1;
    pointer-events: all;
  }

  .cmm-modal {
    background: #fff;
    border-radius: 14px;
    width: 560px;
    max-width: 95vw;
    max-height: 88vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    transform: scale(.95) translateY(14px);
    transition: transform .25s cubic-bezier(.34, 1.4, .64, 1);
    border: 1px solid #e2e8f0;
  }

  #cmm-modal-bg.open .cmm-modal {
    transform: scale(1) translateY(0);
  }

  .cmm-modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px 14px;
    border-bottom: 1px solid #f0f4f8;
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 1;
  }

  .cmm-modal-head-left {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .cmm-modal-head h3 {
    font-size: 0.98rem;
    font-weight: 800;
    color: #1a202c;
    margin: 0;
  }

  .cmm-modal-x {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    background: #f7fafc;
    border: 1px solid #e2e8f0;
    color: #a0aec0;
    cursor: pointer;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .15s;
  }

  .cmm-modal-x:hover {
    background: #edf2f7;
    color: #2d3748;
  }

  .cmm-modal-body {
    padding: 20px 22px;
  }

  .cmm-modal-author-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    background: #f7fafc;
    border-radius: 9px;
    margin-bottom: 16px;
  }

  .cmm-modal-author-info strong {
    font-size: 0.82rem;
    font-weight: 700;
    color: #1a202c;
    display: block;
  }

  .cmm-modal-author-info span {
    font-size: 0.71rem;
    color: #718096;
  }

  .cmm-modal-label {
    font-size: 0.65rem;
    font-weight: 700;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-bottom: 6px;
  }

  .cmm-modal-content-box {
    background: #fafbfc;
    border: 1px solid #edf2f7;
    border-radius: 9px;
    padding: 14px 16px;
    font-size: 0.8rem;
    color: #2d3748;
    line-height: 1.65;
    margin-bottom: 14px;
  }

  .cmm-modal-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 14px;
  }

  .cmm-modal-meta-item {
    background: #f7fafc;
    border-radius: 8px;
    padding: 10px 12px;
  }

  .cmm-modal-meta-item .lbl {
    font-size: 0.64rem;
    color: #a0aec0;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 2px;
  }

  .cmm-modal-meta-item .val {
    font-size: 0.8rem;
    font-weight: 600;
    color: #1a202c;
  }

  .cmm-modal-imgs {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .cmm-modal-img {
    width: 80px;
    height: 64px;
    border-radius: 7px;
    background: #edf2f7;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.65rem;
    color: #a0aec0;
    font-weight: 600;
  }

  .cmm-modal-changes {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .cmm-modal-change-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 10px 12px;
    background: #f7fafc;
    border-radius: 8px;
  }

  .cmm-modal-change-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 5px;
  }

  .cmm-modal-change-text {
    font-size: 0.76rem;
    color: #2d3748;
    line-height: 1.5;
  }

  /* ── REMARKS MODAL ── */
  #cmm-remarks-bg {
    position: fixed;
    inset: 0;
    background: rgba(26, 32, 44, .5);
    backdrop-filter: blur(5px);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s;
  }

  #cmm-remarks-bg.open {
    opacity: 1;
    pointer-events: all;
  }

  .cmm-remarks-modal {
    background: #fff;
    border-radius: 14px;
    width: 520px;
    max-width: 95vw;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
    transform: scale(.95) translateY(14px);
    transition: transform .25s cubic-bezier(.34, 1.4, .64, 1);
    border: 1px solid #e2e8f0;
  }

  #cmm-remarks-bg.open .cmm-remarks-modal {
    transform: scale(1) translateY(0);
  }

  .cmm-remarks-head {
    padding: 18px 22px 14px;
    border-bottom: 1px solid #f0f4f8;
  }

  .cmm-remarks-type {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.68rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 99px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: .06em;
  }

  .cmm-remarks-type.unpub {
    background: #feebc8;
    color: #c05621;
  }

  .cmm-remarks-type.rem {
    background: #fed7d7;
    color: #c53030;
  }

  .cmm-remarks-head h3 {
    font-size: 1rem;
    font-weight: 800;
    color: #1a202c;
    margin: 0 0 3px;
  }

  .cmm-remarks-head p {
    font-size: 0.76rem;
    color: #718096;
    margin: 0;
  }

  .cmm-remarks-body {
    padding: 20px 22px;
  }

  .cmm-remarks-section {
    margin-bottom: 18px;
  }

  .cmm-remarks-section-title {
    font-size: 0.72rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 7px;
  }

  .cmm-remarks-section-title svg {
    width: 14px;
    height: 14px;
  }

  .cmm-checklist {
    display: flex;
    flex-direction: column;
    gap: 7px;
  }

  .cmm-check-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #fafbfc;
    cursor: pointer;
    transition: background .15s, border-color .15s;
  }

  .cmm-check-item:hover {
    background: #f0f4f8;
  }

  .cmm-check-item.checked {
    background: #f0fff4;
    border-color: #9ae6b4;
  }

  .cmm-checkbox {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    border: 1.5px solid #cbd5e0;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all .15s;
  }

  .cmm-check-item.checked .cmm-checkbox {
    background: #38a169;
    border-color: #38a169;
  }

  .cmm-checkbox svg {
    width: 10px;
    height: 10px;
    color: #fff;
    display: none;
  }

  .cmm-check-item.checked .cmm-checkbox svg {
    display: block;
  }

  .cmm-check-label {
    font-size: 0.77rem;
    color: #2d3748;
    font-weight: 500;
  }

  .cmm-check-item.checked .cmm-check-label {
    color: #276749;
  }

  .cmm-remarks-textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 9px;
    font-size: 0.78rem;
    color: #2d3748;
    line-height: 1.6;
    font-family: 'Plus Jakarta Sans', sans-serif;
    resize: vertical;
    min-height: 90px;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
    background: #fafbfc;
  }

  .cmm-remarks-textarea:focus {
    border-color: #c53030;
    box-shadow: 0 0 0 3px rgba(197, 48, 48, 0.08);
    background: #fff;
  }

  .cmm-remarks-textarea::placeholder {
    color: #a0aec0;
  }

  .cmm-remarks-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 22px 18px;
    border-top: 1px solid #f0f4f8;
    gap: 10px;
  }

  .cmm-remarks-cancel {
    font-size: 0.78rem;
    font-weight: 600;
    color: #718096;
    background: #f7fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 16px;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .15s;
  }

  .cmm-remarks-cancel:hover {
    background: #edf2f7;
  }

  .cmm-remarks-confirm {
    font-size: 0.78rem;
    font-weight: 700;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 20px;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .15s;
  }

  .cmm-remarks-confirm.unpub {
    background: #dd6b20;
    box-shadow: 0 2px 8px rgba(221, 107, 32, .3);
  }

  .cmm-remarks-confirm.unpub:hover {
    background: #c05621;
  }

  .cmm-remarks-confirm.rem {
    background: #c53030;
    box-shadow: 0 2px 8px rgba(197, 48, 48, .3);
  }

  .cmm-remarks-confirm.rem:hover {
    background: #9b2c2c;
  }

  /* ── TOAST ── */
  #cmm-toasts {
    position: fixed;
    bottom: 22px;
    right: 22px;
    z-index: 999999;
    display: flex;
    flex-direction: column;
    gap: 9px;
    pointer-events: none;
  }

  .cmm-toast {
    pointer-events: all;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 11px 14px;
    display: flex;
    align-items: flex-start;
    gap: 9px;
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
    min-width: 250px;
    max-width: 310px;
    transform: translateX(110%);
    transition: transform .3s cubic-bezier(.34, 1.5, .64, 1);
  }

  .cmm-toast.show {
    transform: none;
  }

  .cmm-toast.out {
    transform: translateX(110%);
    transition: transform .22s ease-in;
  }

  .cmm-toast-ico {
    width: 26px;
    height: 26px;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cmm-toast-ico.g {
    background: #f0fff4;
    color: #38a169;
  }

  .cmm-toast-ico.o {
    background: #fffaf0;
    color: #dd6b20;
  }

  .cmm-toast-ico.r {
    background: #fff5f5;
    color: #e53e3e;
  }

  .cmm-toast-ico svg {
    width: 13px;
    height: 13px;
  }

  .cmm-toast-body strong {
    display: block;
    font-size: 0.75rem;
    color: #1a202c;
    font-weight: 700;
  }

  .cmm-toast-body span {
    font-size: 0.69rem;
    color: #718096;
  }

  .cmm-toast-x {
    margin-left: auto;
    background: none;
    border: none;
    color: #cbd5e0;
    cursor: pointer;
    font-size: .95rem;
  }

  /* Responsive */
  @media(max-width:1100px) {
    .cmm-stats {
      grid-template-columns: 1fr 1fr;
    }

    .cmm-grid {
      grid-template-columns: 1fr;
    }
  }

  @media(max-width:580px) {
    .cmm {
      padding: 14px 12px 40px;
    }

    .cmm-stats {
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }
  }
</style>

<!-- TOASTS -->
<div id="cmm-toasts"></div>

<!-- PREVIEW MODAL -->
<div id="cmm-modal-bg">
  <div class="cmm-modal" id="cmm-modal">
    <div class="cmm-modal-head">
      <div class="cmm-modal-head-left">
        <div class="cmm-avatar" id="m-avatar">MR</div>
        <h3 id="m-title">Post Title</h3>
      </div>
      <button class="cmm-modal-x" onclick="cmmClose()">✕</button>
    </div>
    <div class="cmm-modal-body" id="m-body"></div>
  </div>
</div>

<!-- REMARKS MODAL -->
<div id="cmm-remarks-bg">
  <div class="cmm-remarks-modal">
    <div class="cmm-remarks-head">
      <div class="cmm-remarks-type" id="rm-type-badge">Unpublish</div>
      <h3 id="rm-title">Post Title</h3>
      <p id="rm-sub">Before proceeding, complete the checklist and provide your remarks.</p>
    </div>
    <div class="cmm-remarks-body">
      <div class="cmm-remarks-section">
        <div class="cmm-remarks-section-title">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
          </svg>
          Checklist — confirm before proceeding
        </div>
        <div class="cmm-checklist" id="rm-checklist"></div>
      </div>
      <div class="cmm-remarks-section">
        <div class="cmm-remarks-section-title">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Admin Remarks <span style="color:#a0aec0;font-weight:400;font-size:0.68rem;">(required)</span>
        </div>
        <textarea class="cmm-remarks-textarea" id="rm-textarea" placeholder="Describe what needs to be fixed, updated, or reviewed before this content can go live again…"></textarea>
      </div>
      <div class="cmm-remarks-section" style="margin-bottom:0;">
        <div class="cmm-remarks-section-title">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          What the content manager needs to do
        </div>
        <div style="background:#fffbf5;border:1px solid #f6ad55;border-radius:9px;padding:12px 14px;" id="rm-instructions"></div>
      </div>
    </div>
    <div class="cmm-remarks-footer">
      <button class="cmm-remarks-cancel" onclick="cmmCloseRemarks()">Cancel</button>
      <button class="cmm-remarks-confirm" id="rm-confirm-btn" onclick="cmmConfirmAction()">Confirm Unpublish</button>
    </div>
  </div>
</div>

<div class="cmm">

  <!-- HEADER -->
  <div class="cmm-header">
    <div>
      <h1>CRM Progress Monitor</h1>
      <p>Monitor all content manager activity — posts, uploads, and page updates in real time</p>
    </div>
    <div class="cmm-online"><span class="dot"></span>CRM User Online</div>
  </div>

  <!-- STATS -->
  <div class="cmm-stats">
    <div class="cmm-sc g">
      <div class="cmm-sc-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg></div>
      <div>
        <div class="cmm-sc-lbl">Total Published</div>
        <div class="cmm-sc-val" id="stat-published">247</div>
        <div class="cmm-sc-sub">Across all modules</div>
      </div>
    </div>
    <div class="cmm-sc b">
      <div class="cmm-sc-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg></div>
      <div>
        <div class="cmm-sc-lbl">Pending Review</div>
        <div class="cmm-sc-val" id="stat-pending">14</div>
        <div class="cmm-sc-sub">Awaiting approval</div>
      </div>
    </div>
    <div class="cmm-sc o">
      <div class="cmm-sc-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg></div>
      <div>
        <div class="cmm-sc-lbl">Files Uploaded</div>
        <div class="cmm-sc-val">89</div>
        <div class="cmm-sc-sub">Images &amp; documents</div>
      </div>
    </div>
    <div class="cmm-sc r">
      <div class="cmm-sc-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg></div>
      <div>
        <div class="cmm-sc-lbl">Needs Attention</div>
        <div class="cmm-sc-val" id="stat-attention">3</div>
        <div class="cmm-sc-sub">Outdated or unpublished</div>
      </div>
    </div>
  </div>

  <!-- MAIN GRID -->
  <div class="cmm-grid">

    <!-- LEFT: MODULES -->
    <div>
      <div class="cmm-card">
        <div class="cmm-card-head" style="padding-bottom:12px;">
          <h2>Module Activity</h2>
          <span id="active-tab-label">Announcements</span>
        </div>

        <!-- TABS -->
        <div class="cmm-tabs">
          <button class="cmm-tab active" onclick="cmmTab(this,'announcements')" data-label="Announcements">
            <span class="cmm-tab-dot" style="background:#38a169"></span>Announcements<span class="cmm-tab-count" id="tc-announcements">32</span>
          </button>
          <button class="cmm-tab" onclick="cmmTab(this,'news')" data-label="News & Accomplishments">
            <span class="cmm-tab-dot" style="background:#3182ce"></span>News &amp; Accomplishments<span class="cmm-tab-count" id="tc-news">58</span>
          </button>
          <button class="cmm-tab" onclick="cmmTab(this,'files')" data-label="Images & Documents">
            <span class="cmm-tab-dot" style="background:#dd6b20"></span>Images &amp; Docs<span class="cmm-tab-count" id="tc-files">89</span>
          </button>
          <button class="cmm-tab" onclick="cmmTab(this,'forms')" data-label="Downloadable Forms">
            <span class="cmm-tab-dot" style="background:#d53f8c"></span>Forms<span class="cmm-tab-count" id="tc-forms">24</span>
          </button>
          <button class="cmm-tab" onclick="cmmTab(this,'faqs')" data-label="FAQs">
            <span class="cmm-tab-dot" style="background:#2c7a7b"></span>FAQs<span class="cmm-tab-count" id="tc-faqs">41</span>
          </button>
        </div>

        <!-- TOOLBAR -->
        <div class="cmm-toolbar">
          <div class="cmm-search-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input class="cmm-search" id="cmm-search-input" type="text" placeholder="Search by title, author, or content…" oninput="cmmSearch()">
          </div>
          <select class="cmm-filter-select" id="cmm-filter-status" onchange="cmmSearch()">
            <option value="">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="unpublished">Unpublished</option>
            <option value="removed">Removed</option>
            <option value="needs update">Needs Update</option>
          </select>
          <select class="cmm-filter-select" id="cmm-filter-author" onchange="cmmSearch()">
            <option value="">All Authors</option>
            <option value="maria reyes">Maria Reyes</option>
            <option value="juan cruz">Juan Cruz</option>
            <option value="ana lim">Ana Lim</option>
          </select>
          <div class="cmm-results-count" id="cmm-results-count">Showing all</div>
        </div>

        <!-- ENTRIES CONTAINER -->
        <div class="cmm-entries-wrap" id="cmm-entries-container"></div>

        <!-- PAGINATION -->
        <div class="cmm-pagination" id="cmm-pagination">
          <div class="cmm-page-info" id="cmm-page-info">Showing 1–8 of 32</div>
          <div class="cmm-page-btns" id="cmm-page-btns"></div>
        </div>
      </div>
    </div>

    <!-- SIDEBAR -->
    <div>
      <div class="cmm-card">
        <div class="cmm-card-head">
          <h2>Public Pages</h2><span>Last updated</span>
        </div>
        <div style="margin-top:10px;">

          <div class="cmm-page-row" onclick="cmmPagePreview('vmv')">
            <div class="cmm-page-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
              </svg></div>
            <div class="cmm-page-info">
              <div class="cmm-page-name">Vision, Mission &amp; Values</div>
              <div class="cmm-page-meta">By <strong>Maria Reyes</strong> — revised mandate &amp; 2026 objectives</div>
            </div>
            <div class="cmm-page-right"><span class="cmm-badge badge-live">Live</span><span class="cmm-page-date">Mar 7, 2026</span></div>
          </div>

          <div class="cmm-page-row" onclick="cmmPagePreview('org')">
            <div class="cmm-page-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg></div>
            <div class="cmm-page-info">
              <div class="cmm-page-name">Organizational Structure</div>
              <div class="cmm-page-meta">By <strong>Juan Cruz</strong> — added 2 division heads, updated org chart</div>
            </div>
            <div class="cmm-page-right"><span class="cmm-badge badge-live">Live</span><span class="cmm-page-date">Mar 3, 2026</span></div>
          </div>

          <div class="cmm-page-row" onclick="cmmPagePreview('district')">
            <div class="cmm-page-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg></div>
            <div class="cmm-page-info">
              <div class="cmm-page-name">District Offices</div>
              <div class="cmm-page-meta">By <strong>Ana Lim</strong> — corrected contact numbers for 3 offices</div>
            </div>
            <div class="cmm-page-right"><span class="cmm-badge badge-live">Live</span><span class="cmm-page-date">Feb 28, 2026</span></div>
          </div>

          <div class="cmm-page-row" onclick="cmmPagePreview('affiliated')">
            <div class="cmm-page-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
              </svg></div>
            <div class="cmm-page-info">
              <div class="cmm-page-name">Affiliated Offices</div>
              <div class="cmm-page-meta">By <strong>Maria Reyes</strong> — links &amp; emails not yet updated</div>
            </div>
            <div class="cmm-page-right"><span class="cmm-badge badge-old">Outdated</span><span class="cmm-page-date">Jan 24, 2026</span></div>
          </div>

          <div class="cmm-page-row" onclick="cmmPagePreview('charter')">
            <div class="cmm-page-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg></div>
            <div class="cmm-page-info">
              <div class="cmm-page-name">Citizens Charter Preview</div>
              <div class="cmm-page-meta">By <strong>Juan Cruz</strong> — still showing 2023 version, 2024 pending</div>
            </div>
            <div class="cmm-page-right"><span class="cmm-badge badge-due">Review Due</span><span class="cmm-page-date">Feb 24, 2026</span></div>
          </div>

          <div class="cmm-page-row" onclick="cmmPagePreview('about')">
            <div class="cmm-page-ico"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
              </svg></div>
            <div class="cmm-page-info">
              <div class="cmm-page-name">About / Overview</div>
              <div class="cmm-page-meta">By <strong>Ana Lim</strong> — refreshed banner &amp; about copy</div>
            </div>
            <div class="cmm-page-right"><span class="cmm-badge badge-live">Live</span><span class="cmm-page-date">Mar 5, 2026</span></div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<script>
  const PER_PAGE = 2;
  let currentTab = 'announcements';
  let currentPage = 1;
  let filteredData = [];
  let pendingAction = null; // { entryId, type }

  // ── ALL ENTRIES DATA ──
  const ALL_ENTRIES = {
    announcements: [{
        id: 'a1',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Mar 10, 2026 · 9:42 AM',
        status: 'published',
        tags: ['General', 'Safety'],
        title: 'Q3 Safety Protocols Update for All Staff',
        body: 'All personnel are reminded to comply with the updated safety protocols effective this quarter. This includes mandatory use of PPE in designated areas, updated evacuation procedures…',
        content: 'All personnel are reminded to comply with the updated safety protocols effective this quarter. This includes mandatory use of PPE in designated areas, updated evacuation procedures, and the newly installed emergency contact system on all floors.\n\nDivision heads are required to conduct a briefing for their respective units no later than March 15.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'General / Safety'
        }, {
          l: 'Views',
          v: '148'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a2',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Mar 8, 2026 · 2:15 PM',
        status: 'published',
        tags: ['Holiday', 'Notice'],
        title: 'Office Closure Notice — March 14, 2026',
        body: 'The office will be closed on March 14 in observance of the regional public holiday. Government transactions will resume on March 15.',
        content: 'The office will be closed on March 14 in observance of the regional public holiday. Government transactions will resume on March 15.\n\nOnline services remain available 24/7 through the citizen portal.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Holiday / Notice'
        }, {
          l: 'Views',
          v: '312'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a3',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Mar 7, 2026 · 4:00 PM',
        status: 'draft',
        tags: ['Hiring'],
        title: 'Upcoming Job Fair — Urban Development Sector',
        body: 'The department will be hosting a job fair for qualified applicants in the Urban Development and Housing sector. Interested parties may register through the official website starting March 20.',
        content: 'The department will be hosting a job fair for qualified applicants in the Urban Development and Housing sector. Interested parties may register through the official website starting March 20.\n\nAvailable positions include Urban Planner I, Administrative Officer II, and Community Development Worker.',
        meta: [{
          l: 'Status',
          v: 'Draft'
        }, {
          l: 'Category',
          v: 'Hiring'
        }, {
          l: 'Views',
          v: '—'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a4',
        avatar: 'AL',
        avatarClass: 'green',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Mar 6, 2026 · 11:00 AM',
        status: 'published',
        tags: ['Events'],
        title: 'Groundbreaking Ceremony — Cavinti Housing Project Phase 2',
        body: 'You are cordially invited to witness the groundbreaking ceremony for Phase 2 of the Cavinti Socialized Housing Project on March 18, 2026 at 9:00 AM.',
        content: 'You are cordially invited to witness the groundbreaking ceremony for Phase 2 of the Cavinti Socialized Housing Project on March 18, 2026 at 9:00 AM. The event will be attended by the Provincial Governor and DHSUD regional representatives.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Events'
        }, {
          l: 'Views',
          v: '209'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a5',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Mar 5, 2026 · 9:00 AM',
        status: 'published',
        tags: ['Memo', 'Compliance'],
        title: 'Reminder: Submission of Individual Work Plans for Q2 2026',
        body: 'All division personnel are reminded to submit their Individual Work Plans (IWP) for Q2 2026 no later than March 20 through the administrative officer.',
        content: 'All division personnel are reminded to submit their Individual Work Plans (IWP) for Q2 2026 no later than March 20 through the administrative officer. Late submissions will be noted in the performance evaluation.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Memo'
        }, {
          l: 'Views',
          v: '87'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a6',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Mar 3, 2026 · 1:30 PM',
        status: 'published',
        tags: ['Meeting'],
        title: 'General Assembly — March 20, 2026 at 8:00 AM',
        body: 'All PUDHO employees are required to attend the General Assembly on March 20. Agenda includes the Q1 performance review and the launch of the new citizen services portal.',
        content: 'All PUDHO employees are required to attend the General Assembly on March 20. Agenda includes the Q1 performance review and the launch of the new citizen services portal.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Meeting'
        }, {
          l: 'Views',
          v: '154'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a7',
        avatar: 'AL',
        avatarClass: 'green',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Feb 28, 2026 · 3:00 PM',
        status: 'published',
        tags: ['Policy'],
        title: 'Updated Dress Code Policy Effective April 2026',
        body: 'The updated dress code policy for all government employees shall take effect on April 1, 2026. Please refer to the CSC Memorandum Circular for complete guidelines.',
        content: 'The updated dress code policy for all government employees shall take effect on April 1, 2026. Please refer to the CSC Memorandum Circular 2026-04 for complete guidelines. Division heads are tasked to disseminate this to all staff.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Policy'
        }, {
          l: 'Views',
          v: '198'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a8',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Feb 25, 2026 · 10:00 AM',
        status: 'published',
        tags: ['Training'],
        title: 'Mandatory Training: Records Management System (March 12)',
        body: 'All records custodians and encoder staff are required to attend the Records Management System training on March 12 at the PDRRMO Conference Room.',
        content: 'All records custodians and encoder staff are required to attend the Records Management System training on March 12 at the PDRRMO Conference Room. Attendance is mandatory; no substitute will be accepted.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Training'
        }, {
          l: 'Views',
          v: '76'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a9',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Feb 22, 2026 · 8:30 AM',
        status: 'draft',
        tags: ['Budget'],
        title: 'FY 2026 Budget Proposal Submission Deadline — Internal',
        body: 'All divisions must submit their FY 2026 budget proposals to the Budget Officer no later than March 5. Use the prescribed form from the Finance Division.',
        content: 'All divisions must submit their FY 2026 budget proposals to the Budget Officer no later than March 5. Use the prescribed form from the Finance Division. Incomplete submissions will be returned.',
        meta: [{
          l: 'Status',
          v: 'Draft'
        }, {
          l: 'Category',
          v: 'Budget'
        }, {
          l: 'Views',
          v: '—'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
      {
        id: 'a10',
        avatar: 'AL',
        avatarClass: 'green',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Feb 18, 2026 · 2:00 PM',
        status: 'published',
        tags: ['Partnership'],
        title: 'MOU Signing with NHA — Expanded Housing Assistance Coverage',
        body: 'PUDHO and the National Housing Authority (NHA) signed a Memorandum of Understanding expanding housing assistance coverage to 3 additional municipalities.',
        content: 'PUDHO and the National Housing Authority (NHA) signed a Memorandum of Understanding on February 17 expanding housing assistance coverage to 3 additional municipalities in Laguna: Magdalena, Mabitac, and Pakil.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Partnership'
        }, {
          l: 'Views',
          v: '341'
        }, {
          l: 'Module',
          v: 'Announcements'
        }]
      },
    ],
    news: [{
        id: 'n1',
        avatar: 'AL',
        avatarClass: 'green',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Mar 9, 2026 · 10:20 AM',
        status: 'published',
        tags: ['Award', 'Accomplishment'],
        title: 'PUDHO Receives Regional Excellence Award 2025',
        body: 'The Provincial Urban Development and Housing Office was honored with the Regional Excellence Award for outstanding service delivery and community development initiatives.',
        content: 'The Provincial Urban Development and Housing Office was honored with the Regional Excellence Award for outstanding service delivery and community development initiatives undertaken throughout 2025. The award was presented during the Provincial Development Summit held in Sta. Cruz, Laguna.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Accomplishment'
        }, {
          l: 'Views',
          v: '523'
        }, {
          l: 'Module',
          v: 'News & Accomplishments'
        }]
      },
      {
        id: 'n2',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Mar 5, 2026 · 3:40 PM',
        status: 'published',
        tags: ['Housing', 'Community'],
        title: '200 Families Benefit from Socialized Housing Program',
        body: 'Two hundred low-income families in the province were successfully relocated under the department\'s socialized housing program in Cavinti.',
        content: 'Two hundred low-income families in the province were successfully relocated under the department\'s socialized housing program. The newly constructed units in Cavinti comply with HLURB standards and include access to basic utilities and community facilities.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Housing'
        }, {
          l: 'Views',
          v: '287'
        }, {
          l: 'Module',
          v: 'News & Accomplishments'
        }]
      },
      {
        id: 'n3',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Feb 28, 2026 · 1:00 PM',
        status: 'published',
        tags: ['Infrastructure'],
        title: 'Road Widening Project Along Provincial Housing Corridors Completed',
        body: 'The road widening project along key housing corridors in San Pedro and Biñan has been completed, improving access for residents in socialized housing communities.',
        content: 'The road widening project along key housing corridors in San Pedro and Biñan has been completed, improving access for residents in socialized housing communities. The project was a collaboration between PUDHO and DPWH-Laguna.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Infrastructure'
        }, {
          l: 'Views',
          v: '192'
        }, {
          l: 'Module',
          v: 'News & Accomplishments'
        }]
      },
      {
        id: 'n4',
        avatar: 'AL',
        avatarClass: 'green',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Feb 20, 2026 · 9:30 AM',
        status: 'draft',
        tags: ['Event'],
        title: 'PUDHO Hosts Regional Urban Planning Forum 2026',
        body: 'The department hosted the annual Regional Urban Planning Forum bringing together planners and officials from 8 provinces.',
        content: 'The department hosted the annual Regional Urban Planning Forum bringing together planners and officials from 8 provinces across CALABARZON. Key discussions focused on climate-resilient urban design and socialized housing standards.',
        meta: [{
          l: 'Status',
          v: 'Draft'
        }, {
          l: 'Category',
          v: 'Event'
        }, {
          l: 'Views',
          v: '—'
        }, {
          l: 'Module',
          v: 'News & Accomplishments'
        }]
      },
    ],
    files: [{
        id: 'f1',
        avatar: 'MR',
        avatarClass: 'purple',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Mar 10, 2026 · 8:00 AM',
        status: 'uploaded',
        tags: ['Photos', '14 files', 'Events'],
        title: 'Q1 2026 Department Photos — Community Outreach',
        body: 'Batch upload of 14 photos from the March 2026 community outreach program in Calamba and San Pablo City.',
        content: 'Batch upload of 14 photos from the March 2026 community outreach program in Calamba and San Pablo City. Photos document the distribution of housing assistance kits and the signing of MOA with barangay officials.\n\nAll images tagged under: Events / Outreach / 2026.',
        hasImages: true,
        meta: [{
          l: 'Files',
          v: '14 images'
        }, {
          l: 'Total Size',
          v: '38.4 MB'
        }, {
          l: 'Category',
          v: 'Events / Outreach'
        }, {
          l: 'Module',
          v: 'Images & Documents'
        }]
      },
      {
        id: 'f2',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Mar 6, 2026 · 11:30 AM',
        status: 'uploaded',
        tags: ['PDF', 'Report', '4.2 MB'],
        title: 'Annual Report 2025 — Final PDF',
        body: 'Official annual report document uploaded to the documents library. File size: 4.2 MB. Categorized under: Reports / Annual / 2025.',
        content: 'Official annual report document for 2025 uploaded to the documents library. This is the final signed version approved by the Provincial Administrator.\n\nFile: PUDHO_Annual_Report_2025_Final.pdf — 4.2 MB.',
        meta: [{
          l: 'File Type',
          v: 'PDF'
        }, {
          l: 'File Size',
          v: '4.2 MB'
        }, {
          l: 'Category',
          v: 'Reports / Annual'
        }, {
          l: 'Module',
          v: 'Images & Documents'
        }]
      },
      {
        id: 'f3',
        avatar: 'AL',
        avatarClass: 'green',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Mar 1, 2026 · 3:00 PM',
        status: 'uploaded',
        tags: ['Photos', '8 files', 'Housing'],
        title: 'Cavinti Housing Project Phase 2 — Construction Photos',
        body: '8 photos documenting the current construction progress of Phase 2 units in Cavinti. For use in the news article and social media updates.',
        content: '8 photos documenting the current construction progress of Phase 2 units in Cavinti. For use in the news article and social media updates.\n\nAll images tagged under: Housing / Construction / 2026.',
        hasImages: true,
        meta: [{
          l: 'Files',
          v: '8 images'
        }, {
          l: 'Total Size',
          v: '18.2 MB'
        }, {
          l: 'Category',
          v: 'Housing / Construction'
        }, {
          l: 'Module',
          v: 'Images & Documents'
        }]
      },
    ],
    forms: [{
        id: 'fm1',
        avatar: 'AL',
        avatarClass: 'teal',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Mar 9, 2026 · 1:00 PM',
        status: 'updated',
        tags: ['PDF', 'Housing', 'Revised'],
        title: 'Application Form for Housing Assistance (Revised 2026)',
        body: 'Form updated to reflect the new income eligibility threshold. Added: Monthly Income Bracket, Proof of Residency type. Replaces the 2024 version.',
        content: 'Form updated to reflect the new income eligibility threshold set by DHSUD Memorandum Circular 2026-01.\n\n• Added: Monthly Income Bracket field\n• Added: Proof of Residency type\n• Removed: Outdated NBI clearance requirement\n• Updated signatory block',
        meta: [{
          l: 'Status',
          v: 'Active / Updated'
        }, {
          l: 'File Type',
          v: 'PDF'
        }, {
          l: 'Version',
          v: '2026 Rev. 1'
        }, {
          l: 'Module',
          v: 'Downloadable Forms'
        }]
      },
      {
        id: 'fm2',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Jan 12, 2026 · 9:00 AM',
        status: 'needs update',
        tags: ['PDF', 'Lot Allocation'],
        title: 'Certificate of Lot Allocation Request Form',
        body: 'This form has not been updated since January. Signatory info may be outdated. Pending review and replacement of authorized signatories on page 2.',
        content: 'This form has not been updated since January. The signatory information on page 2 reflects the previous Chief of Division who has since been reassigned.\n\nPending action: Replace authorized signatories, update office address on footer, and re-upload signed version.',
        meta: [{
          l: 'Status',
          v: 'Needs Update'
        }, {
          l: 'File Type',
          v: 'PDF'
        }, {
          l: 'Last Updated',
          v: 'Jan 12, 2026'
        }, {
          l: 'Module',
          v: 'Downloadable Forms'
        }]
      },
      {
        id: 'fm3',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Feb 14, 2026 · 10:00 AM',
        status: 'updated',
        tags: ['PDF', 'Clearance'],
        title: 'Housing Clearance Application Form (Feb 2026)',
        body: 'Revised housing clearance form with updated processing time and new contact details for the Records Section.',
        content: 'Revised housing clearance form with updated processing time (now 3-5 days, from 5-7 days) and new contact details for the Records Section. Effective February 14, 2026.',
        meta: [{
          l: 'Status',
          v: 'Active'
        }, {
          l: 'File Type',
          v: 'PDF'
        }, {
          l: 'Version',
          v: '2026 Feb'
        }, {
          l: 'Module',
          v: 'Downloadable Forms'
        }]
      },
    ],
    faqs: [{
        id: 'q1',
        avatar: 'AL',
        avatarClass: 'pink',
        author: 'Ana Lim',
        role: 'Content Manager',
        date: 'Mar 7, 2026 · 3:00 PM',
        status: 'published',
        tags: ['Clearance', 'Application'],
        title: 'How do I apply for a housing clearance?',
        body: 'To apply for a housing clearance, visit the PUDHO main office with a valid ID, proof of residency, barangay certification, and accomplished application form.',
        content: 'To apply for a housing clearance, visit the PUDHO main office with the following:\n\n• Valid government-issued ID (2 copies)\n• Proof of residency (at least 6 months)\n• Barangay certification\n• Duly accomplished application form\n\nProcessing time is 3-5 working days. No fees for indigent applicants.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Clearance'
        }, {
          l: 'Views',
          v: '904'
        }, {
          l: 'Module',
          v: 'FAQs'
        }]
      },
      {
        id: 'q2',
        avatar: 'JC',
        avatarClass: 'blue',
        author: 'Juan Cruz',
        role: 'Content Manager',
        date: 'Mar 3, 2026 · 10:00 AM',
        status: 'published',
        tags: ['Lot', 'Requirements'],
        title: 'What are the requirements for lot allocation?',
        body: 'Requirements for lot allocation include proof of income, marriage certificate, barangay indigency certificate, and completed PUDHO lot allocation form.',
        content: 'Requirements for lot allocation include:\n\n• Proof of income (latest ITR or employer certificate)\n• Marriage certificate (if applicable)\n• Barangay indigency certificate\n• Completed PUDHO lot allocation form\n\nSubmit all requirements to Window 3 — Land Allocation Division.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Lot Allocation'
        }, {
          l: 'Views',
          v: '671'
        }, {
          l: 'Module',
          v: 'FAQs'
        }]
      },
      {
        id: 'q3',
        avatar: 'MR',
        avatarClass: '',
        author: 'Maria Reyes',
        role: 'Content Manager',
        date: 'Feb 26, 2026 · 2:00 PM',
        status: 'published',
        tags: ['Relocation', 'Benefits'],
        title: 'What benefits are included in the relocation package?',
        body: 'The relocation package includes a residential lot, basic utility connections, and a starter housing unit compliant with HLURB minimum standards.',
        content: 'The relocation package includes:\n\n• A residential lot (36 sqm minimum)\n• Basic utility connections (water, electricity)\n• A starter housing unit compliant with HLURB minimum standards\n• Access to community facilities\n\nBeneficiaries must reside in the unit within 60 days of turnover.',
        meta: [{
          l: 'Status',
          v: 'Published'
        }, {
          l: 'Category',
          v: 'Relocation'
        }, {
          l: 'Views',
          v: '432'
        }, {
          l: 'Module',
          v: 'FAQs'
        }]
      },
    ],
  };

  // Entry status state (mutable)
  const entryState = {};
  Object.values(ALL_ENTRIES).flat().forEach(e => {
    entryState[e.id] = e.status;
  });

  // ── TABS ──
  function cmmTab(btn, id) {
    document.querySelectorAll('.cmm-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    currentTab = id;
    currentPage = 1;
    document.getElementById('active-tab-label').textContent = btn.dataset.label;
    document.getElementById('cmm-search-input').value = '';
    document.getElementById('cmm-filter-status').value = '';
    document.getElementById('cmm-filter-author').value = '';
    renderEntries();
  }

  // ── SEARCH / FILTER ──
  function cmmSearch() {
    currentPage = 1;
    renderEntries();
  }

  function getFiltered() {
    const q = document.getElementById('cmm-search-input').value.toLowerCase().trim();
    const st = document.getElementById('cmm-filter-status').value.toLowerCase();
    const au = document.getElementById('cmm-filter-author').value.toLowerCase();
    return ALL_ENTRIES[currentTab].filter(e => {
      const st2 = entryState[e.id] || e.status;
      const matchQ = !q || e.title.toLowerCase().includes(q) || e.author.toLowerCase().includes(q) || e.body.toLowerCase().includes(q);
      const matchSt = !st || st2.toLowerCase() === st;
      const matchAu = !au || e.author.toLowerCase() === au;
      return matchQ && matchSt && matchAu;
    });
  }

  // ── RENDER ──
  function renderEntries() {
    filteredData = getFiltered();
    const total = filteredData.length;
    const totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
    if (currentPage > totalPages) currentPage = totalPages;

    const start = (currentPage - 1) * PER_PAGE;
    const slice = filteredData.slice(start, start + PER_PAGE);

    const container = document.getElementById('cmm-entries-container');

    if (slice.length === 0) {
      container.innerHTML = `<div class="cmm-empty"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg><p>No entries match your search or filter.</p></div>`;
    } else {
      container.innerHTML = slice.map(e => renderEntry(e)).join('');
    }

    // Results count
    const countEl = document.getElementById('cmm-results-count');
    if (total === ALL_ENTRIES[currentTab].length) {
      countEl.textContent = `${total} entries`;
    } else {
      countEl.textContent = `${total} of ${ALL_ENTRIES[currentTab].length} entries`;
    }

    // Page info
    const s = Math.min(start + 1, total);
    const en = Math.min(start + PER_PAGE, total);
    document.getElementById('cmm-page-info').textContent = total === 0 ? 'No results' : `Showing ${s}–${en} of ${total}`;

    renderPagination(totalPages);
    updateTabCounts();
  }

  function statusBadge(st) {
    const map = {
      'published': '<span class="cmm-badge badge-pub">Published</span>',
      'draft': '<span class="cmm-badge badge-draft">Draft</span>',
      'unpublished': '<span class="cmm-badge badge-unpub">Unpublished</span>',
      'removed': '<span class="cmm-badge badge-removed">Removed</span>',
      'needs update': '<span class="cmm-badge badge-review">Needs Update</span>',
      'updated': '<span class="cmm-badge badge-update">Updated</span>',
      'uploaded': '<span class="cmm-badge badge-update">Uploaded</span>',
    };
    return map[st] || `<span class="cmm-badge badge-draft">${st}</span>`;
  }

  function renderEntry(e) {
    const st = entryState[e.id] || e.status;
    const isUnpub = st === 'unpublished';
    const isRemoved = st === 'removed';
    let cls = '';
    if (isUnpub) cls = ' unpublished';
    if (isRemoved) cls = ' removed';

    const canUnpublish = ['published', 'draft', 'updated', 'uploaded'].includes(st);
    const canRemove = ['published', 'draft', 'unpublished', 'updated', 'uploaded', 'needs update'].includes(st);
    const canRestore = isUnpub || isRemoved;

    let actionBtns = '';
    if (canRestore) {
      actionBtns = `<button class="cmm-action-btn restore" onclick="event.stopPropagation();cmmRestore('${e.id}')">↩ Restore</button>`;
    } else {
      if (canUnpublish) actionBtns += `<button class="cmm-action-btn unpublish" onclick="event.stopPropagation();cmmOpenRemarks('${e.id}','unpublish')">Unpublish</button>`;
      if (canRemove) actionBtns += `<button class="cmm-action-btn remove"    onclick="event.stopPropagation();cmmOpenRemarks('${e.id}','remove')">Remove</button>`;
    }

    const imgStrip = e.hasImages ? `<div class="cmm-img-strip"><div class="cmm-thumb">IMG 1</div><div class="cmm-thumb">IMG 2</div><div class="cmm-thumb">IMG 3</div><div class="cmm-thumb">+more</div></div>` : '';

    return `
  <div class="cmm-entry${cls}" onclick="cmmPreview('${e.id}')">
    <div class="cmm-entry-top">
      <div class="cmm-entry-author">
        <div class="cmm-avatar ${e.avatarClass}">${e.avatar}</div>
        <div class="cmm-entry-who">
          <strong>${e.author}</strong>
          <span>${e.role}</span>
        </div>
      </div>
      <div class="cmm-entry-right">
        <div style="display:flex;gap:4px;align-items:center;flex-wrap:wrap;justify-content:flex-end;">
          ${statusBadge(st)}
          ${actionBtns}
        </div>
        <span class="cmm-entry-date">${e.date}</span>
      </div>
    </div>
    <div class="cmm-entry-title">${e.title}</div>
    <div class="cmm-entry-body">${e.body}</div>
    ${imgStrip}
    <div class="cmm-entry-footer">
      ${(e.tags||[]).map(t=>`<span class="cmm-entry-tag">${t}</span>`).join('')}
    </div>
  </div>`;
  }

  // ── PAGINATION ──
  function renderPagination(totalPages) {
    const btns = document.getElementById('cmm-page-btns');
    btns.innerHTML = '';

    // Prev
    const prev = document.createElement('button');
    prev.className = 'cmm-page-btn';
    prev.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>`;
    prev.disabled = currentPage === 1;
    prev.onclick = () => {
      if (currentPage > 1) {
        currentPage--;
        renderEntries();
      }
    };
    btns.appendChild(prev);

    // Page numbers
    let pages = [];
    if (totalPages <= 5) {
      for (let i = 1; i <= totalPages; i++) pages.push(i);
    } else {
      pages = [1];
      if (currentPage > 3) pages.push('…');
      for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) pages.push(i);
      if (currentPage < totalPages - 2) pages.push('…');
      pages.push(totalPages);
    }

    pages.forEach(p => {
      if (p === '…') {
        const el = document.createElement('button');
        el.className = 'cmm-page-btn';
        el.textContent = '…';
        el.disabled = true;
        btns.appendChild(el);
      } else {
        const el = document.createElement('button');
        el.className = 'cmm-page-btn' + (p === currentPage ? ' active' : '');
        el.textContent = p;
        el.onclick = () => {
          currentPage = p;
          renderEntries();
        };
        btns.appendChild(el);
      }
    });

    // Next
    const next = document.createElement('button');
    next.className = 'cmm-page-btn';
    next.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
    next.disabled = currentPage === totalPages;
    next.onclick = () => {
      if (currentPage < totalPages) {
        currentPage++;
        renderEntries();
      }
    };
    btns.appendChild(next);
  }

  function updateTabCounts() {
    Object.keys(ALL_ENTRIES).forEach(tab => {
      const el = document.getElementById('tc-' + tab);
      if (el) el.textContent = ALL_ENTRIES[tab].length;
    });
  }

  // ── PREVIEW MODAL ──
  function getEntryById(id) {
    return Object.values(ALL_ENTRIES).flat().find(e => e.id === id);
  }

  function cmmPreview(id) {
    const e = getEntryById(id);
    if (!e) return;
    const st = entryState[id] || e.status;
    document.getElementById('m-avatar').textContent = e.avatar;
    document.getElementById('m-avatar').className = 'cmm-avatar' + (e.avatarClass ? ' ' + e.avatarClass : '');
    document.getElementById('m-title').textContent = e.title;
    let html = `
    <div class="cmm-modal-author-row">
      <div class="cmm-avatar ${e.avatarClass}">${e.avatar}</div>
      <div class="cmm-modal-author-info">
        <strong>${e.author}</strong>
        <span>${e.role} &nbsp;·&nbsp; ${e.date}</span>
      </div>
    </div>
    <div class="cmm-modal-label" style="margin-bottom:6px;">Content</div>
    <div class="cmm-modal-content-box">${e.content.replace(/\n/g,'<br>')}</div>`;
    if (e.hasImages) {
      html += `<div class="cmm-modal-label" style="margin-bottom:8px;">Uploaded Images</div>
    <div class="cmm-modal-imgs" style="margin-bottom:14px;">
      <div class="cmm-modal-img">IMG 1</div><div class="cmm-modal-img">IMG 2</div>
      <div class="cmm-modal-img">IMG 3</div><div class="cmm-modal-img">+more</div>
    </div>`;
    }
    html += `<div class="cmm-modal-label" style="margin-bottom:8px;">Details</div>
    <div class="cmm-modal-meta-grid">
      <div class="cmm-modal-meta-item"><div class="lbl">Current Status</div><div class="val">${st.charAt(0).toUpperCase()+st.slice(1)}</div></div>
      ${e.meta.slice(1).map(m=>`<div class="cmm-modal-meta-item"><div class="lbl">${m.l}</div><div class="val">${m.v}</div></div>`).join('')}
    </div>`;
    document.getElementById('m-body').innerHTML = html;
    document.getElementById('cmm-modal-bg').classList.add('open');
  }

  function cmmClose() {
    document.getElementById('cmm-modal-bg').classList.remove('open');
  }
  document.getElementById('cmm-modal-bg').addEventListener('click', function(e) {
    if (e.target === this) cmmClose();
  });

  // ── REMARKS MODAL ──
  const CHECKLISTS = {
    unpublish: [
      'Verified that the content contains inaccurate or outdated information',
      'Confirmed with the content manager that this needs revision',
      'Checked that no active links or references depend on this post',
      'Notified the relevant division head of the temporary unpublish',
    ],
    remove: [
      'Verified that this content is no longer relevant or needed',
      'Confirmed that no downloadable files or links point to this entry',
      'Backed up or archived the content before removal',
      'Obtained approval from the supervising admin or division head',
      'Checked that removing this will not break any public-facing page',
    ],
  };

  const INSTRUCTIONS = {
    unpublish: `<ul style="margin:0;padding-left:16px;font-size:0.75rem;color:#92400e;line-height:1.8;">
    <li>Content manager will be <strong>notified</strong> with your remarks</li>
    <li>They must <strong>revise and resubmit</strong> for admin review before it goes live again</li>
    <li>The post will be <strong>hidden from the public</strong> until restored</li>
    <li>A log entry will be created showing the admin action and timestamp</li>
  </ul>`,
    remove: `<ul style="margin:0;padding-left:16px;font-size:0.75rem;color:#92400e;line-height:1.8;">
    <li>The content will be <strong>temporarily removed</strong> from the public site</li>
    <li>Content manager will receive your remarks as a <strong>task to resolve</strong></li>
    <li>Entry will be <strong>marked as Removed</strong> and listed in the flagged section</li>
    <li>Admin must <strong>manually restore</strong> the entry once issues are resolved</li>
  </ul>`,
  };

  function cmmOpenRemarks(id, type) {
    const e = getEntryById(id);
    if (!e) return;
    pendingAction = {
      id,
      type
    };

    const badge = document.getElementById('rm-type-badge');
    badge.textContent = type === 'unpublish' ? 'Unpublish Post' : 'Remove Post';
    badge.className = 'cmm-remarks-type ' + (type === 'unpublish' ? 'unpub' : 'rem');

    document.getElementById('rm-title').textContent = e.title;
    document.getElementById('rm-sub').textContent = type === 'unpublish' ?
      'This will hide the post from the public. Provide your reason so the content manager knows what to fix.' :
      'This will temporarily remove the post and flag it. Provide clear instructions for the content manager.';

    // Checklist
    const cl = document.getElementById('rm-checklist');
    cl.innerHTML = CHECKLISTS[type].map((item, i) =>
      `<div class="cmm-check-item" onclick="toggleCheck(this)" data-idx="${i}">
      <div class="cmm-checkbox"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
      <span class="cmm-check-label">${item}</span>
    </div>`
    ).join('');

    document.getElementById('rm-instructions').innerHTML = INSTRUCTIONS[type];
    document.getElementById('rm-textarea').value = '';

    const btn = document.getElementById('rm-confirm-btn');
    btn.textContent = type === 'unpublish' ? 'Confirm Unpublish' : 'Confirm Remove';
    btn.className = 'cmm-remarks-confirm ' + (type === 'unpublish' ? 'unpub' : 'rem');

    document.getElementById('cmm-remarks-bg').classList.add('open');
  }

  function toggleCheck(el) {
    el.classList.toggle('checked');
  }

  function cmmCloseRemarks() {
    document.getElementById('cmm-remarks-bg').classList.remove('open');
    pendingAction = null;
  }
  document.getElementById('cmm-remarks-bg').addEventListener('click', function(e) {
    if (e.target === this) cmmCloseRemarks();
  });

  function cmmConfirmAction() {
    if (!pendingAction) return;
    const remarks = document.getElementById('rm-textarea').value.trim();
    if (!remarks) {
      document.getElementById('rm-textarea').focus();
      document.getElementById('rm-textarea').style.borderColor = '#c53030';
      setTimeout(() => document.getElementById('rm-textarea').style.borderColor = '', 1800);
      showToast('r', 'Remarks required', 'Please provide your remarks before confirming.');
      return;
    }
    const {
      id,
      type
    } = pendingAction;
    entryState[id] = type === 'unpublish' ? 'unpublished' : 'removed';
    cmmCloseRemarks();
    renderEntries();
    const label = type === 'unpublish' ? 'Post unpublished' : 'Post removed';
    const msg = type === 'unpublish' ? 'The post is now hidden from the public.' : 'The post has been temporarily removed.';
    showToast(type === 'unpublish' ? 'o' : 'r', label, msg);
  }

  function cmmRestore(id) {
    entryState[id] = 'published';
    renderEntries();
    showToast('g', 'Post restored', 'The entry has been set back to Published.');
  }

  // ── PAGE PREVIEW ──
  const PAGE_MODAL = {
    vmv: {
      title: 'Vision, Mission & Values',
      avatarCls: '',
      initials: 'MR',
      author: 'Maria Reyes',
      date: 'March 7, 2026 at 2:30 PM',
      changes: [{
        c: '#38a169',
        t: 'Updated mandate statement to align with 2026 Provincial Development Plan'
      }, {
        c: '#3182ce',
        t: 'Added 3 new strategic objectives under the Vision section'
      }, {
        c: '#dd6b20',
        t: 'Reformatted Core Values — changed from bullets to icon cards'
      }],
      meta: [{
        l: 'Page Status',
        v: 'Live'
      }, {
        l: 'Last Editor',
        v: 'Maria Reyes'
      }, {
        l: 'Page Views / Month',
        v: '3,412'
      }, {
        l: 'Sections',
        v: '3'
      }]
    },
    org: {
      title: 'Organizational Structure',
      avatarCls: 'blue',
      initials: 'JC',
      author: 'Juan Cruz',
      date: 'March 3, 2026 at 4:00 PM',
      changes: [{
        c: '#38a169',
        t: 'Added 2 new Division Head entries — Planning & Engineering'
      }, {
        c: '#3182ce',
        t: 'Replaced org chart image with March 2026 version'
      }, {
        c: '#718096',
        t: 'Corrected job title of OIC-Director'
      }],
      meta: [{
        l: 'Page Status',
        v: 'Live'
      }, {
        l: 'Last Editor',
        v: 'Juan Cruz'
      }, {
        l: 'Page Views / Month',
        v: '1,874'
      }, {
        l: 'Units Shown',
        v: '12'
      }]
    },
    district: {
      title: 'District Offices',
      avatarCls: 'green',
      initials: 'AL',
      author: 'Ana Lim',
      date: 'February 28, 2026 at 10:15 AM',
      changes: [{
        c: '#38a169',
        t: 'Updated contact numbers for Calamba, Sta. Cruz, and Biñan offices'
      }, {
        c: '#3182ce',
        t: 'Added office hours schedule to San Pablo District entry'
      }],
      meta: [{
        l: 'Page Status',
        v: 'Live'
      }, {
        l: 'Last Editor',
        v: 'Ana Lim'
      }, {
        l: 'Page Views / Month',
        v: '2,211'
      }, {
        l: 'Offices Listed',
        v: '18'
      }]
    },
    affiliated: {
      title: 'Affiliated Offices',
      avatarCls: '',
      initials: 'MR',
      author: 'Maria Reyes',
      date: 'January 24, 2026 at 3:00 PM',
      changes: [{
        c: '#e53e3e',
        t: 'Links to HLURB and DHSUD still pointing to old domains'
      }, {
        c: '#e53e3e',
        t: 'Email addresses for 2 agencies are outdated (bouncing)'
      }, {
        c: '#dd6b20',
        t: 'Last edit was 45 days ago — page requires immediate update'
      }],
      meta: [{
        l: 'Page Status',
        v: 'Outdated'
      }, {
        l: 'Last Editor',
        v: 'Maria Reyes'
      }, {
        l: 'Page Views / Month',
        v: '987'
      }, {
        l: 'Offices Listed',
        v: '9'
      }]
    },
    charter: {
      title: 'Citizens Charter Preview',
      avatarCls: 'blue',
      initials: 'JC',
      author: 'Juan Cruz',
      date: 'February 24, 2026 at 9:00 AM',
      changes: [{
        c: '#e53e3e',
        t: 'Currently displaying 2023 edition — annual review overdue'
      }, {
        c: '#dd6b20',
        t: '2024 edition uploaded but not yet set as active version'
      }, {
        c: '#3182ce',
        t: 'Action: Activate 2024 version and archive 2023'
      }],
      meta: [{
        l: 'Page Status',
        v: 'Review Due'
      }, {
        l: 'Current Version',
        v: '2023 Edition'
      }, {
        l: 'Page Views / Month',
        v: '4,103'
      }, {
        l: 'Pending',
        v: 'Activate 2024'
      }]
    },
    about: {
      title: 'About / Overview',
      avatarCls: 'green',
      initials: 'AL',
      author: 'Ana Lim',
      date: 'March 5, 2026 at 11:00 AM',
      changes: [{
        c: '#38a169',
        t: 'Refreshed homepage banner with new 2026 outreach photo'
      }, {
        c: '#3182ce',
        t: 'Updated About copy — added 2025 accomplishments summary'
      }, {
        c: '#38a169',
        t: 'Fixed broken link to the Annual Report download'
      }],
      meta: [{
        l: 'Page Status',
        v: 'Live'
      }, {
        l: 'Last Editor',
        v: 'Ana Lim'
      }, {
        l: 'Page Views / Month',
        v: '5,620'
      }, {
        l: 'Last Updated',
        v: 'Mar 5, 2026'
      }]
    },
  };

  function cmmPagePreview(key) {
    const d = PAGE_MODAL[key];
    if (!d) return;
    document.getElementById('m-avatar').textContent = d.initials;
    document.getElementById('m-avatar').className = 'cmm-avatar' + (d.avatarCls ? ' ' + d.avatarCls : '');
    document.getElementById('m-title').textContent = d.title;
    let html = `
    <div class="cmm-modal-author-row">
      <div class="cmm-avatar ${d.avatarCls}">${d.initials}</div>
      <div class="cmm-modal-author-info">
        <strong>${d.author}</strong>
        <span>Last edited &nbsp;·&nbsp; ${d.date}</span>
      </div>
    </div>
    <div class="cmm-modal-label" style="margin-bottom:8px;">What was done</div>
    <div class="cmm-modal-changes">
      ${d.changes.map(c=>`<div class="cmm-modal-change-row"><div class="cmm-modal-change-dot" style="background:${c.c}"></div><div class="cmm-modal-change-text">${c.t}</div></div>`).join('')}
    </div>
    <br>
    <div class="cmm-modal-label" style="margin-bottom:8px;">Page Info</div>
    <div class="cmm-modal-meta-grid">
      ${d.meta.map(m=>`<div class="cmm-modal-meta-item"><div class="lbl">${m.l}</div><div class="val">${m.v}</div></div>`).join('')}
    </div>`;
    document.getElementById('m-body').innerHTML = html;
    document.getElementById('cmm-modal-bg').classList.add('open');
  }

  // ── TOAST ──
  function showToast(type, title, msg) {
    const icons = {
      g: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`,
      o: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>`,
      r: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`,
    };
    const el = document.createElement('div');
    el.className = 'cmm-toast';
    el.innerHTML = `<div class="cmm-toast-ico ${type}">${icons[type]}</div><div class="cmm-toast-body"><strong>${title}</strong><span>${msg}</span></div><button class="cmm-toast-x" onclick="this.closest('.cmm-toast').remove()">✕</button>`;
    document.getElementById('cmm-toasts').appendChild(el);
    requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
    setTimeout(() => {
      el.classList.add('out');
      setTimeout(() => el.remove(), 250);
    }, 3800);
  }

  // ── INIT ──
  renderEntries();
</script>

@endsection