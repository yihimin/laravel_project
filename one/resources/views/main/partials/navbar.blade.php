<!-- Navigation -->
<nav class="navbar navbar-expand-lg" style="background-color: #8B5E3C; color: #FFF;">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}" style="color: #FFF; font-family: 'Georgia', serif; font-size: 1.5rem;">Brew & Carry</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(100%);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                @if (session()->has('is_admin') && session('is_admin') == 1)
                    <!-- Admin Panel -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="adminDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FFF;">관리자 화면</a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">제품 관리</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">사용자 관리</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.stats.index') }}">통계</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- Right-side Buttons -->
            <div class="d-flex align-items-center">
                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" 
                class="btn btn-outline-light me-2 position-relative" 
                style="background-color: #A67B5B; border-color: #8B5E3C; color: #FFF;">
                    <i class="bi-cart-fill me-1"></i>
                    장바구니
                    <span class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle rounded-pill">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
              
            <!-- Auth Buttons -->
            <div id="authButton" class="ms-2">
                @if (session()->has('user_id'))
                    <!-- 로그인 상태 -->
                    <span class="me-2 text-white">안녕하세요, {{ session('user_name') }}님!</span>
                @else
                    <!-- 비로그인 상태 -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-sm btn-outline-light">로그인</a>
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- 로그인 모달 -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">로그인</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">아이디</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="admin" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">비밀번호</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="1234" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">로그인</button>
                </form>
            </div>
        </div>
    </div>
</div>
