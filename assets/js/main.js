/**
* Template Name: Active
* Template URL: https://bootstrapmade.com/active-bootstrap-website-template/
* Updated: Aug 07 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  mobileNavToggleBtn.addEventListener('click', mobileNavToogle);

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper tabs sliders
   */
  function initSwiperTabs() {
    document
      .querySelectorAll(".init-swiper-tabs")
      .forEach(function(swiperElement) {
        let config = JSON.parse(
          swiperElement.querySelector(".swiper-config").innerHTML.trim()
        );

        const dotsContainer = swiperElement
          .closest("section")
          .querySelector(".js-custom-dots");
        if (!dotsContainer) return;

        const customDots = dotsContainer.querySelectorAll("a");

        // Remove the default pagination setting
        delete config.pagination;

        const swiperInstance = new Swiper(swiperElement, config);

        swiperInstance.on("slideChange", function() {
          updateSwiperTabsPagination(swiperInstance, customDots);
        });

        customDots.forEach((dot, index) => {
          dot.addEventListener("click", function(e) {
            e.preventDefault();
            swiperInstance.slideToLoop(index);
            updateSwiperTabsPagination(swiperInstance, customDots);
          });
        });

        updateSwiperTabsPagination(swiperInstance, customDots);
      });
  }

  function updateSwiperTabsPagination(swiperInstance, customDots) {
    const activeIndex = swiperInstance.realIndex;
    customDots.forEach((dot, index) => {
      if (index === activeIndex) {
        dot.classList.add("active");
      } else {
        dot.classList.remove("active");
      }
    });
  }

  window.addEventListener("load", initSwiperTabs);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

})();


$(document).ready(function () {
  let currentPage = 1;

  // Fetch initial products
  fetchProducts();

  // Fetch filters
  fetchFilters();

  // Fetch products
  function fetchProducts() {
      const brand = $('input[name="brand"]:checked').val() || '';
      const category = $('input[name="category"]:checked').val() || '';

      $.ajax({
          url: 'fetch_products.php',
          type: 'POST',
          data: { brand, category, page: currentPage },
          success: function (response) {
              const products = JSON.parse(response);
              renderProducts(products);
              renderPagination();
          }
      });
  }

  // Fetch filters
  function fetchFilters() {
      $.ajax({
          url: 'fetch_filters.php', // Create a separate PHP script to fetch brand and category filters
          type: 'GET',
          success: function (response) {
              const filters = JSON.parse(response);
              renderFilters(filters);
          }
      });
  }

  // Render products
  function renderProducts(products) {
      const productGrid = $('#product-grid');
      productGrid.empty();

      products.forEach(product => {
          productGrid.append(`
              <div class="product-card">
                  <img src="${product.p_image1}" alt="${product.product_title}">
                  <h4>${product.product_title}</h4>
                  <p>${product.brand_name} - ${product.category_name}</p>
                  <p>Pack Size: ${product.pack_size}</p>
              </div>
          `);
      });
  }

  // Render filters
  function renderFilters(filters) {
      const brandFilters = $('#brand-filters');
      const categoryFilters = $('#category-filters');

      filters.brands.forEach(brand => {
          brandFilters.append(`
              <label><input type="radio" name="brand" value="${brand.brand_id}">${brand.brand_name}</label>
          `);
      });

      filters.categories.forEach(category => {
          categoryFilters.append(`
              <label><input type="radio" name="category" value="${category.categories_id}">${category.category_name}</label>
          `);
      });

      // Add change listeners
      $('input[name="brand"], input[name="category"]').change(fetchProducts);
  }

  // Render pagination
  function renderPagination() {
      const pagination = $('#pagination');
      pagination.empty();

      for (let i = 1; i <= 5; i++) { // Assume 5 pages for now
          pagination.append(`
              <button class="page-link" data-page="${i}">${i}</button>
          `);
      }

      $('.page-link').click(function () {
          currentPage = $(this).data('page');
          fetchProducts();
      });
  }
});

$(document).ready(function () {
  // Update filters dynamically when an option is clicked
  $('.filter-option').on('change', function () {
      let brand = $('input[name="brand"]:checked').val();
      let category = $('input[name="category"]:checked').val();

      // Reload page with updated filters
      let query = `?brand=${brand || ''}&category=${category || ''}`;
      window.location.href = query;
  });
});


$(document).ready(function () {
  let selectedFilters = {
      brand: [],
      category: []
  };

  // Initialize filters based on URL parameters
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('brand')) {
      selectedFilters.brand = urlParams.get('brand').split(',');
  }
  if (urlParams.get('category')) {
      selectedFilters.category = urlParams.get('category').split(',');
  }

  // Handle filter button click
  $('.filter-btn').on('click', function () {
      const filterType = $(this).data('filter');
      const filterId = $(this).data('id');

      // Toggle selection
      if ($(this).hasClass('active')) {
          $(this).removeClass('active');
          selectedFilters[filterType] = selectedFilters[filterType].filter(id => id !== filterId.toString());
      } else {
          $(this).addClass('active');
          selectedFilters[filterType].push(filterId.toString());
      }

      // Update URL and reload page
      const queryParams = new URLSearchParams();
      if (selectedFilters.brand.length > 0) {
          queryParams.set('brand', selectedFilters.brand.join(','));
      }
      if (selectedFilters.category.length > 0) {
          queryParams.set('category', selectedFilters.category.join(','));
      }
      queryParams.set('page', 1); // Reset to first page
      window.location.search = queryParams.toString();
  });
});


$(document).ready(function () {
  $('#apply-filters').on('click', function () {
      const selectedBrands = $('#brand-filter').val();
      const selectedCategories = $('#category-filter').val();

      // Build query string for filters
      const queryParams = new URLSearchParams();
      if (selectedBrands && selectedBrands.length > 0) {
          queryParams.set('brand', selectedBrands.join(','));
      }
      if (selectedCategories && selectedCategories.length > 0) {
          queryParams.set('category', selectedCategories.join(','));
      }

      // Navigate to updated URL
      window.location.search = queryParams.toString();
  });
});
