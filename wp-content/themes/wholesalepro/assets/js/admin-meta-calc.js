/* global jQuery */
/**
 * WholesalePro Admin – Property Meta Auto-Calculator
 * Loaded only on property edit screens.
 */
(function() {
  'use strict';

  function parseNum(id) {
    var val = parseFloat((document.getElementById(id) || {}).value) || 0;
    return val;
  }

  function recalcProfit() {
    var arv        = parseNum('_arv');
    var repairCost = parseNum('_repair_cost');
    var asking     = parseNum('_asking_price');

    // Profit = ARV - Repair Cost - Asking Price
    if (arv > 0 && asking > 0) {
      var profit = arv - repairCost - asking;
      var profitEl = document.getElementById('_profit');
      if (profitEl) {
        profitEl.value = profit.toFixed(2);
        profitEl.style.color = profit > 0 ? '#2e7d32' : '#c62828';
      }
    }
  }

  function recalcDaysListed() {
    var listedDateEl = document.getElementById('_date_listed');
    var daysEl       = document.getElementById('_days_listed');
    if (!listedDateEl || !daysEl) return;

    var listedDate = new Date(listedDateEl.value);
    if (isNaN(listedDate.getTime())) return;

    var now  = new Date();
    var diff = Math.floor((now - listedDate) / (1000 * 60 * 60 * 24));
    daysEl.value = Math.max(0, diff);
  }

  document.addEventListener('DOMContentLoaded', function() {
    var watchIds = ['_arv', '_repair_cost', '_asking_price'];
    watchIds.forEach(function(id) {
      var el = document.getElementById(id);
      if (el) {
        el.addEventListener('input', recalcProfit);
        el.addEventListener('change', recalcProfit);
        el.addEventListener('blur', recalcProfit);
      }
    });

    var dateListed = document.getElementById('_date_listed');
    if (dateListed) {
      dateListed.addEventListener('change', recalcDaysListed);
    }

    // Run on load in case values are already populated
    recalcProfit();
    recalcDaysListed();
  });
})();
