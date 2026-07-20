@php
    $user = auth()->user();
    $initials = collect(explode(' ', $user->name))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
@endphp

<div class="user-nav" id="userNav">
    <button type="button" class="user-nav__trigger" id="userNavTrigger" aria-expanded="false" aria-haspopup="true" aria-label="Account menu">
        @if($user->avatar)
            <img src="{{ $user->avatar }}" alt="" class="user-nav__avatar">
        @else
            <span class="user-nav__avatar user-nav__avatar--placeholder">{{ strtoupper($initials) }}</span>
        @endif
        <span class="user-nav__name d-none d-md-inline">{{ $user->name }}</span>
        <i class="fa-solid fa-chevron-down user-nav__chevron"></i>
    </button>

    <div class="user-nav__dropdown" id="userNavDropdown" role="menu">
        <div class="user-nav__profile">
            <p class="user-nav__profile-name">{{ $user->name }}</p>
            <p class="user-nav__profile-email">{{ $user->email }}</p>
        </div>
        <ul class="user-nav__menu">
            <li>
                <a href="{{ route('user.dashboard') }}" role="menuitem">
                    <i class="fa-solid fa-gauge-high"></i>
                    My Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('courses') }}" role="menuitem">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Browse Trainings
                </a>
            </li>
            <li>
                <a href="{{ route('books.index') }}" role="menuitem">
                    <i class="fa-solid fa-book"></i>
                    Browse Books
                </a>
            </li>
        </ul>
        <div class="user-nav__divider"></div>
        <ul class="user-nav__menu">
            <li>
                <form action="{{ route('auth.logout') }}" method="POST" id="logoutForm">
                    @csrf
                    <button type="submit" class="user-nav__logout" role="menuitem">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Sign out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
