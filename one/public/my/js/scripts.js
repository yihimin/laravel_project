document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault();  // 폼 제출 기본 동작 막기

    const formData = new FormData(this);

    fetch("{{ route('login') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            // 로그인 성공 후 버튼을 '로그아웃'으로 변경
            document.getElementById("authButton").innerHTML = `
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">로그아웃</button>
                </form>
            `;
            // 로그인 성공 후 리다이렉트
            window.location.href = data.redirect_url;  // 로그인 후 리다이렉트 URL로 이동
        } else {
            alert("로그인 실패: " + data.message);  // 실패 메시지 출력
        }
    })
    .catch((error) => console.error("Error:", error));
});
