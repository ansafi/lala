document.addEventListener("DOMContentLoaded", function() {
    const sideMenu = document.querySelector('aside');
    const menuBtn = document.querySelector('#menu_bar');
    const closeBtn = document.querySelector('#close_btn');
    const themeToggler = document.querySelector('.theme-toggler');
    const sidebarLinks = document.querySelectorAll('.sidebar a');
  
    // Toggle side menu
    menuBtn.addEventListener('click', () => {
      sideMenu.style.display = "block";
    });
  
    closeBtn.addEventListener('click', () => {
      sideMenu.style.display = "none";
    });
  
    // Toggle theme
    themeToggler.addEventListener('click', () => {
      document.body.classList.toggle('dark-theme-variables');
      themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
      themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
    });
  
    // // Handle sidebar menu clicks
    // sidebarLinks.forEach(link => {
    //   link.addEventListener('click', function(e) {
    //     e.preventDefault();
  
    //     const target = this.getAttribute('data-target');
    //     const activeMenu = document.querySelector('.sidebar a.active');
    //     const activeContent = document.querySelector('main .content.active');
  
    //     if (activeMenu) {
    //       activeMenu.classList.remove('active');
    //     }
    //     this.classList.add('active');
  
    //     if (activeContent) {
    //       activeContent.classList.remove('active');
    //     }
  
    //     const targetContent = document.querySelector(`#${target}`);
    //     if (targetContent) {
    //       targetContent.classList.add('active');
    //     }
  
    //     // Execute specific logic for each menu
    //     if (target === 'dashboard-content') {
    //       console.log('Menu Dashboard clicked');
    //       loadDashboardContent();
    //     } else if (target === 'customers-content') {
    //       console.log('Menu Customers clicked');
    //       showCustomerList();
    //     } else if (target === 'analytics-content') {
    //       console.log('Menu Analytics clicked');
    //       showSalesAnalytics();
    //     }
    //   });
    // });
  
    // Example functions for loading content (to be defined)
    function loadDashboardContent() {
      console.log('Loading dashboard content...');
      // Add your logic to load dashboard content here
    }
  
    function showCustomerList() {
      console.log('Showing customer list...');
      // Add your logic to show customer list here
    }
  
    function showSalesAnalytics() {
      console.log('Showing sales analytics...');
      // Add your logic to show sales analytics here
    }
  });
  
  
  
  
  
  