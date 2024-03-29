<!--APP-SIDEBAR-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="index.php?pagina=1">
            <img src="assets/images/brand/galleta-logo-2.svg" class="header-brand-img light-logo1" alt="logo">
        </a><!-- LOGO -->
    </div>

    <ul class="side-menu">
        <!-- Marketing -->
        <?php if ($rowUser['id_tipo'] == "1"): ?>
        <li class="slide">
            <a class="side-menu__item" href="./index.php?pagina=1">
                <i class="fas fa-home fa-lg  mr-2"></i>
                <span class="side-menu__label">Inicio</span>
            </a>
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fas fa-desktop fa-lg mr-2"></i> <span class="side-menu__label">Marketing</span><i
                    class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="index.php?pagina=1"><span>Clientes</span></a></li>
            </ul>
            <a class="side-menu__item" href="./clientes.php">
                <i class="fas fa-home fa-lg  mr-2"></i>
                <span class="side-menu__label">Mis Servicios</span>
            </a>
        </li>

        <?php else: ?>
        <li class="slide">
            <a class="side-menu__item" href="https://panel.galletamkt.com/index.php?pagina=1">
                <i class="fas fa-home fa-lg  mr-2"></i>
                <span class="side-menu__label">Inicio</span>
            </a>
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fas fa-desktop fa-lg mr-2"></i> <span class="side-menu__label">Marketing</span><i
                    class="angle fa fa-angle-right"></i>
            </a>

            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fas fa-desktop fa-lg mr-2"></i> <span class="side-menu__label">Marketing</span><i
                    class="angle fa fa-angle-right"></i>
            </a>
            <?php if ($_GET['id'] === null): ?>

            
            <?php else: ?>
                <ul class="slide-menu">
                <li>
                    <a class="slide-item" style="cursor: pointer;"
                onclick="window.location='estadisticas.php?id=<?php echo $_GET['id']; ?>&company=<?php echo $_GET['company']; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>';"><span>Historico</span></a>
                </li>
                <li>
                    <a class="slide-item" style="cursor: pointer;"
                onclick="window.location='cac.php?id=<?php echo $_GET['id']; ?>&company=<?php echo $_GET['company']; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>';"><span>CAC</span></a>
                </li>
            </ul>
            <?php endif; ?>
        </li>

        <?php endif; ?>
        <!-- <li><h3>Widgets & Maps, Mails</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="widgets.html">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                <span class="side-menu__label">Widgets</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="maps.html">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4C9.24 4 7 6.24 7 9c0 2.85 2.92 7.21 5 9.88 2.11-2.69 5-7 5-9.88 0-2.76-2.24-5-5-5zm0 7.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" opacity=".3"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg>
                <span class="side-menu__label">Maps</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
                <span class="side-menu__label">Mail</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="email-compose.html" class="slide-item">Mail-Compose</a></li>
                <li><a href="email-inbox.html" class="slide-item">Mail-Inbox</a></li>
                <li><a href="email-view.html" class="slide-item">View-Mail</a></li>
            </ul>
        </li>
        <li><h3>Elements</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm2.01 10.01L6.5 17.5l3.49-7.51L17.5 6.5l-3.49 7.51z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5.5-2.5l7.51-3.49L17.5 6.5 9.99 9.99 6.5 17.5zm5.5-6.6c.61 0 1.1.49 1.1 1.1s-.49 1.1-1.1 1.1-1.1-.49-1.1-1.1.49-1.1 1.1-1.1z"/></svg>
                <span class="side-menu__label">Components</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="cards.html" class="slide-item"> Cards design</a></li>
                <li><a href="calendar.html" class="slide-item"> Default calendar</a></li>
                <li><a href="calendar2.html" class="slide-item"> Full calendar</a></li>
                <li><a href="chat.html" class="slide-item"> Default Chat</a></li>
                <li><a href="notify.html" class="slide-item"> Notifications</a></li>
                <li><a href="sweetalert.html" class="slide-item"> Sweet alerts</a></li>
                <li><a href="rangeslider.html" class="slide-item"> Range slider</a></li>
                <li><a href="scroll.html" class="slide-item"> Content Scroll bar</a></li>
                <li><a href="loaders.html" class="slide-item"> Loaders</a></li>
                <li><a href="counters.html" class="slide-item"> Counters</a></li>
                <li><a href="rating.html" class="slide-item"> Rating</a></li>
                <li><a href="timeline.html" class="slide-item"> Timeline</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg>
                <span class="side-menu__label">Elements</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="alerts.html" class="slide-item"> Alerts</a></li>
                <li><a href="buttons.html" class="slide-item"> Buttons</a></li>
                <li><a href="dropdown.html" class="slide-item"> Dropdowns</a></li>
                <li><a href="colors.html" class="slide-item"> Colors</a></li>
                <li><a href="avatarsquare.html" class="slide-item"> Avatar-Square</a></li>
                <li><a href="avatar-round.html" class="slide-item"> Avatar-Rounded</a></li>
                <li><a href="avatar-radius.html" class="slide-item"> Avatar-Radius</a></li>
                <li><a href="list.html" class="slide-item"> Lists & ListGroups</a></li>
                <li><a href="tags.html" class="slide-item"> Tags</a></li>
                <li><a href="pagination.html" class="slide-item"> Pagination</a></li>
                <li><a href="navigation.html" class="slide-item"> Navigation</a></li>
                <li><a href="typography.html" class="slide-item"> Typography</a></li>
                <li><a href="breadcrumbs.html" class="slide-item"> Breadcrumbs</a></li>
                <li><a href="badge.html" class="slide-item"> Badges</a></li>
                <li><a href="jumbotron.html" class="slide-item"> Jumbotron</a></li>
                <li><a href="panels.html" class="slide-item"> Panels</a></li>
                <li><a href="thumbnails.html" class="slide-item"> Thumbnails</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 9h14V5H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5S7.83 8.5 7 8.5 5.5 7.83 5.5 7 6.17 5.5 7 5.5zM5 19h14v-4H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5z" opacity=".3"/><path d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zm-1 6H5v-4h14v4zm-12-.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 6H5V5h14v4zM7 8.5c.83 0 1.5-.67 1.5-1.5S7.83 5.5 7 5.5 5.5 6.17 5.5 7 6.17 8.5 7 8.5z"/></svg>
                <span class="side-menu__label">Advanced Elements</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="mediaobject.html" class="slide-item"> Media Object</a></li>
                <li><a href="accordion.html" class="slide-item"> Accordions</a></li>
                <li><a href="tabs.html" class="slide-item"> Tabs</a></li>
                <li><a href="modal.html" class="slide-item"> Modal</a></li>
                <li><a href="tooltipandpopover.html" class="slide-item"> Tooltip and popover</a></li>
                <li><a href="progress.html" class="slide-item"> Progress</a></li>
                <li><a href="carousel.html" class="slide-item"> Carousels</a></li>
                <li><a href="headers.html" class="slide-item"> Headers</a></li>
                <li><a href="footers.html" class="slide-item"> Footers</a></li>
                <li><a href="users-list.html" class="slide-item"> User List</a></li>
                <li><a href="search.html" class="slide-item">Search</a></li>
                <li><a href="crypto-currencies.html" class="slide-item"> Crypto-currencies</a></li>
            </ul>
        </li>
        <li><h3>Charts & Tables</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"  class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5v14h14V5H5zm4 12H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg>
                <span class="side-menu__label">Charts</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="chart-chartist.html" class="slide-item">Chart Js</a></li>
                <li><a href="chart-flot.html" class="slide-item"> Flot Charts</a></li>
                <li><a href="chart-echart.html" class="slide-item"> ECharts</a></li>
                <li><a href="chart-morris.html" class="slide-item"> Morris Charts</a></li>
                <li><a href="chart-nvd3.html" class="slide-item"> Nvd3 Charts</a></li>
                <li><a href="charts.html" class="slide-item"> C3 Bar Charts</a></li>
                <li><a href="chart-line.html" class="slide-item"> C3 Line Charts</a></li>
                <li><a href="chart-donut.html" class="slide-item"> C3 Donut Charts</a></li>
                <li><a href="chart-pie.html" class="slide-item"> C3 Pie charts</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h15v3H5zm12 5h3v9h-3zm-7 0h5v9h-5zm-5 0h3v9H5z" opacity=".3"/><path d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM8 19H5v-9h3v9zm7 0h-5v-9h5v9zm5 0h-3v-9h3v9zm0-11H5V5h15v3z"/></svg>
                <span class="side-menu__label">Tables</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="tables.html" class="slide-item">Default table</a></li>
                <li><a href="datatable.html" class="slide-item"> Data Tables</a></li>
            </ul>
        </li>
        <li><h3>Forms & Icons</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5z" opacity=".3"/><path d="M20 8l-6-6H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8zm-2 12H6V4h7v5h5v11z"/></svg>
                <span class="side-menu__label">Forms</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="form-elements.html" class="slide-item"> Form Elements</a></li>
                <li><a href="wysiwyag.html" class="slide-item"> Form Editor</a></li>
                <li><a href="form-wizard.html" class="slide-item"> Form Wizard</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" opacity=".3"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z"/><circle cx="6.5" cy="11.5" r="1.5"/><circle cx="9.5" cy="7.5" r="1.5"/><circle cx="14.5" cy="7.5" r="1.5"/><circle cx="17.5" cy="11.5" r="1.5"/></svg>
                <span class="side-menu__label">Icons</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="icons.html" class="slide-item"> Font Awesome</a></li>
                <li><a href="icons2.html" class="slide-item"> Material Design Icons</a></li>
                <li><a href="icons3.html" class="slide-item"> Simple Line Icons</a></li>
                <li><a href="icons4.html" class="slide-item"> Feather Icons</a></li>
                <li><a href="icons5.html" class="slide-item"> Ionic Icons</a></li>
                <li><a href="icons6.html" class="slide-item"> Flag Icons</a></li>
                <li><a href="icons7.html" class="slide-item"> pe7 Icons</a></li>
                <li><a href="icons8.html" class="slide-item"> Themify Icons</a></li>
                <li><a href="icons9.html" class="slide-item">Typicons Icons</a></li>
                <li><a href="icons10.html" class="slide-item">Weather Icons</a></li>
            </ul>
        </li>
        <li><h3>Pages</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7 3h14v14H7z" opacity=".3"/><path d="M3 23h16v-2H3V5H1v16c0 1.1.9 2 2 2zM21 1H7c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 16H7V3h14v14z"/></svg>
                <span class="side-menu__label">Pages</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="profile.html" class="slide-item"> Profile</a></li>
                <li><a href="editprofile.html" class="slide-item"> Edit Profile</a></li>
                <li><a href="gallery.html" class="slide-item"> Gallery</a></li>
                <li><a href="about.html" class="slide-item"> About Company</a></li>
                <li><a href="services.html" class="slide-item"> Services</a></li>
                <li><a href="faq.html" class="slide-item"> FAQS</a></li>
                <li><a href="terms.html" class="slide-item"> Terms</a></li>
                <li><a href="invoice.html" class="slide-item"> Invoice</a></li>
                <li><a href="pricing.html" class="slide-item"> Pricing Tables</a></li>
                <li><a href="blog.html" class="slide-item"> Blog</a></li>
                <li><a href="empty.html" class="slide-item"> Empty Page</a></li>
                <li><a href="construction.html" class="slide-item"> Under Construction</a></li>
            </ul>
        </li>
        <li><h3>E-Commerce</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.55 11l2.76-5H6.16l2.37 5z" opacity=".3"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                <span class="side-menu__label">E-Commerce</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="shop.html" class="slide-item"> Shop</a></li>
                <li><a href="shop-description.html" class="slide-item">Product Details</a></li>
                <li><a href="cart.html" class="slide-item"> Shopping Cart</a></li>
            </ul>
        </li>
        <li><h3>Custom & Error Pages</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm0 12.5c-2.49 0-4.5-2.01-4.5-4.5S9.51 7.5 12 7.5s4.5 2.01 4.5 4.5-2.01 4.5-4.5 4.5z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-12.5c-2.49 0-4.5 2.01-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.01 4.5-4.5-2.01-4.5-4.5-4.5zm0 5.5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/></svg>
                <span class="side-menu__label">Custom Pages</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="login.html" class="slide-item"> Login</a></li>
                <li><a href="register.html" class="slide-item"> Register</a></li>
                <li><a href="forgot-password.html" class="slide-item"> Forgot Password</a></li>
                <li><a href="lockscreen.html" class="slide-item"> Lock screen</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9.1 5L5 9.1v5.8L9.1 19h5.8l4.1-4.1V9.1L14.9 5H9.1zM12 17c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm1-3h-2V7h2v7z" opacity=".3"/><path d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM19 14.9L14.9 19H9.1L5 14.9V9.1L9.1 5h5.8L19 9.1v5.8z"/><circle cx="12" cy="16" r="1"/><path d="M11 7h2v7h-2z"/></svg>
                <span class="side-menu__label">Error Pages</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="400.html" class="slide-item"> 400</a></li>
                <li><a href="401.html" class="slide-item"> 401</a></li>
                <li><a href="403.html" class="slide-item"> 403</a></li>
                <li><a href="404.html" class="slide-item"> 404</a></li>
                <li><a href="500.html" class="slide-item"> 500</a></li>
                <li><a href="503.html" class="slide-item"> 503</a></li>
            </ul>
        </li> -->
    </ul>
</aside>
<!--/APP-SIDEBAR-->