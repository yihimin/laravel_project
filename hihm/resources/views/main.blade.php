<!doctype html>
<html lang="kr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>판매관리</title>
 <link href="{{ asset('my/css/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('my/css/my.css') }}" rel="stylesheet">
 <script src="{{ asset('my/js/jquery-3.7.1.min.js') }}"></script>
 <script src="{{ asset('my/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('my/js/moment-with-locales.min.js') }}"></script>
 <script src="{{ asset('my/js/bootstrap5-datetimepicker.js') }}"></script>
 <link href="{{ asset('my/css/bootstrap5-datetimepicker.css') }}" rel="stylesheet">
 <link href="{{ asset('my/css/all.min.css') }}" rel="stylesheet">
 
 <style>
    /* 나뭇잎 애니메이션 CSS */
    .falling-leaves-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
      z-index: -1;
    }
    .leaf {
        position: absolute;
        top: -50px;
        width: 30px;
        height: 30px;
        background-image: url('{{ asset('/my/img/leaf.png') }}'); 
        background-size: contain;
        background-repeat: no-repeat;
        opacity: 0.8;
        animation: fall linear infinite;
        }

        @keyframes fall {
        0% {
            transform: translateY(0) rotate(0deg); /* 시작 위치 */
            opacity: 0.8;
        }
        100% {
            transform: translateY(100vh) rotate(360deg); /* 수직으로 떨어지기 */
            opacity: 0;
        }
    }
  </style>
</head>
<body>
<div class="falling-leaves-container"></div>
<div class="container">

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
   <a class="navbar-brand" href="http://gamejigix.induk.ac.kr/~sale19/sale/public/">판매관리</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item"><a class="nav-link" href="{{ route('jangbui.index') }}">매입</a></li>
     <li class="nav-item"><a class="nav-link" href="{{ route('jangbuo.index') }}">매출</a></li>
     <li class="nav-item"><a class="nav-link" href="{{ route('gigan.index') }}">기간조회</a></li>
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
       role="button" data-bs-toggle="dropdown" aria-expanded="false">통계</a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
       <li><a class="dropdown-item" href="{{ route('best.index') }}">BEST제품</a></li>
       <li><a class="dropdown-item" href="{{ route('crosstab.index') }}">월별제품별현황</a></li>
       <li><a class="dropdown-item" href="{{ route('chart.index') }}">종류별 분포도</a></li>
      </ul>
     </li>
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
       role="button" data-bs-toggle="dropdown" aria-expanded="false">기초정보</a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
       <li><a class="dropdown-item" href="{{ route('gubun.index') }}">구분</a></li>
       <li><a class="dropdown-item" href="{{ route('product.index') }}">제품</a></li>
       @if (session()->get("rank") == 1)
       <li><hr class="dropdown-divider"></li>
       <li><a class="dropdown-item" href="{{ route('member.index') }}">사용자</a></li>
       @endif
      </ul>
     </li>
     <li class="nav-item"><a class="nav-link" href="{{ route('picture.index') }}">사진</a></li>
     <li class="nav-item"><a class="nav-link" href="{{ route('ajax.index') }}">Ajax 구분</a></li>
     <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Test</a></li>
    </ul>
    
	@if (!session()->exists("uid"))
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-outline-secondary btn-dark">로그인</a>
	@else
		<form id="logout-form" action="{{ url('login/logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
		<a href="#" class="btn btn-sm btn-outline-secondary btn-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">로그아웃</a>
	@endif

   </div>
  </div>
 </nav>

 <!-- 슬라이드창 -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1"
            class="active" aria-current="true" ></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
           <img src="{{asset('/my/img/001.png')}}" height="300" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="{{asset('/my/img/002.png')}}" height="300" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="{{asset('/my/img/003.png')}}" height="300" class="d-block w-100">
         </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
    @yield('content')

    <script>
    // 나뭇잎 생성 JavaScript
        function createLeaf() {
        const leaf = document.createElement('div');
        leaf.classList.add('leaf');
        
        // 나뭇잎이 전체 화면에서 랜덤하게 나타나도록 위치 설정
        leaf.style.left = Math.random() * 100 + 'vw'; // 0%에서 100% 사이의 랜덤 위치
        
        // 애니메이션 지속 시간과 투명도 설정
        leaf.style.animationDuration = Math.random() * 3 + 5 + 's'; // 5~8초 지속 시간
        leaf.style.opacity = Math.random() * 0.5 + 0.5; // 50% ~ 100% 불투명도
        
        document.querySelector('.falling-leaves-container').appendChild(leaf);

        // 애니메이션이 끝난 후 나뭇잎 제거
        leaf.addEventListener('animationend', () => {
            leaf.remove();
        });
        }

        // 일정 간격으로 나뭇잎 생성
        setInterval(createLeaf, 500); // 0.5초마다 나뭇잎 생성
</script>
</body>
</html>


<!-- 모달창 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

           <div class="modal-header mycolor1">
               <h5 class="modal-title" id="exampleModalLabel">로그인</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>

           <div class="modal-body bg-light">
              <form name="form_login" method="post" action="{{ url('login/check') }}">
               @csrf
              <table class="table table-borderless mymargin5">
                  <tr>
                      <td width="30%"><h6>아이디</h6></td>
                      <td width="70%"><input type="text" name="uid" class="form-control"></td>
                  </tr>
                  <tr>
                      <td><h6>암&nbsp;호</h6></td>
                      <td><input type="password" name="pwd" class="form-control"></td>
                  </tr>
              </table>
              </form>
          </div>

          <div class="modal-footer alert-secondary">
              <button type="button" class="btn btn-sm btn-secondary" onclick="document.form_login.submit();">확인</button>
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">닫기</button>
          </div>
       </div>
   </div>
</div>
