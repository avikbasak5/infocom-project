<aside class="main-sidebar sidebar-dark-warning elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="{{ site_settings('site_favicon') }}" alt="{{ site_settings('site_name') }}" class="brand-image"> <!--Extra class : img-circle elevation-3 -->
    <span class="brand-text font-weight-light">{{ site_settings('site_name') }}</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link {{ Nav::isRoute('dashboard') }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              {{ __('admin.dashboard') }}
            </p>
          </a>
        </li>
        <li class="nav-item {{ Nav::hasSegment(['manage-conference-category','manage-event-type','manage-sponsorship-type','manage-sponsors','manage-speakers','manage-contact-information'], 1 ,'menu-is-opening menu-open') }}">
          <a href="#" class="nav-link {{ Nav::hasSegment(['manage-conference-category','manage-event-type','manage-sponsorship-type','manage-sponsors','manage-speakers','manage-contact-information']) }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              {{ __('admin.master_setup') }}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ Nav::hasSegment(['manage-conference-category','manage-event-type','manage-sponsorship-type','manage-sponsors','manage-speakers','manage-contact-information']) }}">
            <li class="nav-item">
              <a href="{{route('conference_category')}}" class="nav-link {{ Nav::hasSegment('manage-conference-category') }}">
                <i class="fas fa-cubes nav-icon"></i>
                <p>{{ __('admin.conference_category') }}</p>
                <!-- <span class="right badge badge-info">2</span> -->
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('event_type')}}" class="nav-link {{ Nav::hasSegment('manage-event-type') }}">
                <i class="fas fa-cubes nav-icon"></i>
                <p>{{ __('admin.event_type') }}</p>
                <!-- <span class="right badge badge-info">2</span> -->
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sponsorship_type')}}" class="nav-link {{ Nav::hasSegment('manage-sponsorship-type') }}">
                <i class="fas fa-cubes nav-icon"></i>
                <p>{{ __('admin.sponsorship_type') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sponsors')}}" class="nav-link {{ Nav::hasSegment('manage-sponsors') }}">
                <i class="far fa-user nav-icon"></i>
                <p>{{ __('admin.all') }} {{ __('admin.sponsors') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('speakers')}}" class="nav-link {{ Nav::hasSegment('manage-speakers') }}">
                <i class="nav-icon fas fa-volume-up"></i>
                <p>{{ __('admin.all') }} {{ __('admin.speakers') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('contact_information')}}" class="nav-link {{ Nav::hasSegment('manage-contact-information') }}">
                <i class="fas fa-cubes nav-icon"></i>
                <p>{{ __('admin.contact_information') }}</p>
                <!-- <span class="right badge badge-info">2</span> -->
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('users')}}" class="nav-link {{ Nav::isResource('manage-users') }}">
            <i class="nav-icon fas fa-user-secret"></i>
            <p>
              {{ __('admin.users') }}
            </p>
          </a>
        </li>
        <li class="nav-item {{ Nav::hasSegment(['manage-conference','manage-event'], 1, 'menu-is-opening menu-open') }}">
          <a href="{{route('conference')}}" class="nav-link {{ Nav::hasSegment(['manage-conference','manage-event']) }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              {{ __('admin.conference') }}
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>
          <!-- <ul class="nav nav-treeview {{ Nav::hasSegment(['manage-conference','manage-event']) }}">
            <li class="nav-item">
              <a href="{{route('conference')}}" class="nav-link {{ Nav::hasSegment('manage-conference') }}">
                <i class="fas fa-list nav-icon"></i>
                <p>{{ __('admin.conference') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ Nav::isResource('manage-event') }}">
                <i class="fas fa-calendar nav-icon"></i>
                <p>Invite Contacts</p>
              </a>
            </li>
          </ul> -->
        </li>
        <li class="nav-item {{ Nav::hasSegment(['manage-contacts-group','manage-contacts'], 1 ,'menu-is-opening menu-open') }}">
          <a href="#" class="nav-link {{ Nav::hasSegment(['manage-contacts-group','manage-contacts']) }}">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
              {{ __('admin.contacts') }}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ Nav::hasSegment(['manage-contacts-group','manage-contacts']) }}">
            <li class="nav-item">
              <a href="{{route('contacts_group')}}" class="nav-link {{ Nav::hasSegment('manage-contacts-group') }}">
                <i class="fas fa-cubes nav-icon"></i>
                <p>{{ __('admin.contacts_group') }}</p>
                <!-- <span class="right badge badge-info">2</span> -->
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('contacts')}}" class="nav-link {{ Nav::hasSegment('manage-contacts') }}">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  {{ __('admin.contacts') }}
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item {{ Nav::hasSegment(['manage-invitation'], 1 ,'menu-is-opening menu-open') }}">
          <a href="#" class="nav-link {{ Nav::hasSegment(['manage-invitation']) }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              {{ __('admin.invitation') }}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ Nav::hasSegment(['manage-invitation']) }}">
            <li class="nav-item">
              <a href="#" class="nav-link {{ Nav::hasSegment('manage-contacts-group') }}">
                <i class="fas fa-plus nav-icon"></i>
                <p>{{ __('admin.new') }} {{ __('admin.invitation') }}</p>
                <!-- <span class="right badge badge-info">2</span> -->
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ Nav::hasSegment('manage-contacts') }}">
                <i class="nav-icon fas fa-share-square"></i>
                <p>
                  {{ __('admin.invitation') }} {{ __('admin.sent') }}
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('registration_request')}}" class="nav-link {{ Nav::isResource('manage-registration-request') }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              {{ __('admin.registration_request') }}
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>