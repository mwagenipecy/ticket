<div>
<!-- BEGIN: Email Sorting Dropdown -->
<div class="dropdown relative">
  <button 
    data-tw-toggle="dropdown"
    aria-expanded="false"
    id="email-sort-dropdown-toggle"
    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed box px-2">
    <span class="flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <polyline points="19 12 12 19 5 12"></polyline>
      </svg>
      <span class="ml-1">Sort By</span>
    </span>
  </button>
  
  <div
    id="email-sort-dropdown-menu"
    class="dropdown-menu absolute z-[9999] hidden"
  >
    <div class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 mt-px w-48">
      <div class="p-2 font-medium text-slate-700 dark:text-slate-200">Time Period</div>
      
      <a href="#" data-value="today" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Today
      </a>
      
      <a href="#" data-value="yesterday" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Yesterday
      </a>
      
      <a href="#" data-value="last_7_days" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
        </svg>
        Last 7 Days
      </a>
      
      <a href="#" data-value="last_week" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Last Week
      </a>
      
      <a href="#" data-value="last_month" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Last Month
      </a>
      
      <a href="#" data-value="last_quarter" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Last Quarter
      </a>
      
      <a href="#" data-value="last_year" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Last Year
      </a>
      
      <div class="h-px my-2 -mx-2 bg-slate-200/60 dark:bg-darkmode-400"></div>
      
      <div class="p-2 font-medium text-slate-700 dark:text-slate-200">Custom</div>
      
      <a href="#" data-value="custom_range" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:hover:bg-darkmode-400 dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Custom Date Range
      </a>
    </div>
  </div>
  
  <script>
    // Simple dropdown toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
      const toggleButton = document.getElementById('email-sort-dropdown-toggle');
      const dropdownMenu = document.getElementById('email-sort-dropdown-menu');
      
      // Toggle dropdown when clicking the button
      toggleButton.addEventListener('click', function(e) {
        e.preventDefault();
        dropdownMenu.classList.toggle('hidden');
      });
      
      // Close dropdown when clicking outside
      document.addEventListener('click', function(event) {
        if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
      
      // Handle sorting option selection
      const sortOptions = document.querySelectorAll('.dropdown-item');
      sortOptions.forEach(option => {
        option.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Get the selected sort value
          const sortValue = this.getAttribute('data-value');
          
          // You can update your URL here or trigger an AJAX request
          // For example:
          // window.location.href = window.location.pathname + '?sort=' + sortValue;
          
          // For demo purposes, we'll just log the value
          console.log('Sorting by:', sortValue);
          
          // Update the button text to show what's selected
          const buttonText = document.querySelector('#email-sort-dropdown-toggle span.ml-1');
          buttonText.textContent = this.textContent.trim();
          
          // Hide dropdown after selection
          dropdownMenu.classList.add('hidden');
        });
      });
    });
  </script>
</div>
<!-- END: Email Sorting Dropdown -->

</div>
