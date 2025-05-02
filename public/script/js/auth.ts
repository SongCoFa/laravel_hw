document.addEventListener("DOMContentLoaded", () => {
    type RegisterForm = {
        name: string;
        password: string;
        email: string;
    };

    let registerForm: RegisterForm = {
        name: '',
        password: '',
        email: '',
    };

    type LoginForm = {
        name: string;
        password: string;
    };

    let loginForm: LoginForm = {
        name: '',
        password: '',
    };

    const registerButton = document.querySelector("#register-btn") as HTMLButtonElement;
    const registerFormInputs = document.querySelectorAll("#register-form input");

    const loginButton = document.querySelector("#login-btn") as HTMLButtonElement;
    const loginFormInputs = document.querySelectorAll("#login-form input");

    registerFormInputs.forEach(input => {
        input.addEventListener("keyup", handleRegisterInputChange);
        input.addEventListener("change", handleRegisterInputChange);
    });

    function handleRegisterInputChange(event: Event) {
        const input = event.target as HTMLInputElement;
        const id = input.dataset.id as keyof RegisterForm;
        const value = input.value;

        if (id in registerForm) {
            registerForm[id] = value;
        }

        const code = event instanceof KeyboardEvent ? event.which ?? event.keyCode : 0;

        if (id === 'email' && code === 13) {
            registerButton?.click();
        }
    }

    loginFormInputs.forEach(input => {
        input.addEventListener("keyup", handleLoginInputChange);
        input.addEventListener("change", handleLoginInputChange);
    });

    function handleLoginInputChange(event: Event) {
        const input = event.target as HTMLInputElement;
        const id = input.dataset.id as keyof LoginForm;
        const value = input.value;

        if (id in loginForm) {
            loginForm[id] = value;
        }

        const code = event instanceof KeyboardEvent ? event.which ?? event.keyCode : 0;

        if (id === 'password' && code === 13) {
            loginButton?.click();
        }
    }

    const registerUser = async () => {
        try {
            const response = await fetch('post_register', {
                method: 'POST', // 設定請求方法
                headers: {
                    'Content-Type': 'application/json', // 告訴伺服器我們正在發送 JSON
                },
                body: JSON.stringify(registerForm), // 將資料轉為 JSON 字串
            });

            // 檢查是否請求成功
            if (response.ok) {
                const data = await response.json(); // 解析回應的 JSON 資料
                console.log('註冊成功:', data);
            } else {
                console.error('註冊失敗:', response.statusText);
            }
        } catch (error) {
            console.error('錯誤:', error);
        }
    };

    registerButton?.addEventListener("click", () => {
        console.log(registerForm);
        registerUser();
    });

    const loginUser = async () => {
        try {
            const response = await fetch('post_login', {
                method: 'POST', // 設定請求方法
                headers: {
                    'Content-Type': 'application/json', // 告訴伺服器我們正在發送 JSON
                },
                body: JSON.stringify(loginForm), // 將資料轉為 JSON 字串
            });

            // 檢查是否請求成功
            if (response.ok) {
                const data = await response.json(); // 解析回應的 JSON 資料
                console.log('登入成功:', data);
            } else {
                console.error('登入失敗:', response.statusText);
            }
        } catch (error) {
            console.error('錯誤:', error);
        }
    };

    loginButton?.addEventListener("click", () => {
        console.log(loginForm);
        loginUser();
    });
});
