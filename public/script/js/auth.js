var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g = Object.create((typeof Iterator === "function" ? Iterator : Object).prototype);
    return g.next = verb(0), g["throw"] = verb(1), g["return"] = verb(2), typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var _this = this;
document.addEventListener("DOMContentLoaded", function () {
    var registerForm = {
        name: '',
        password: '',
        email: '',
    };
    var loginForm = {
        name: '',
        password: '',
    };
    var registerButton = document.querySelector("#register-btn");
    var registerFormInputs = document.querySelectorAll("#register-form input");
    var loginButton = document.querySelector("#login-btn");
    var loginFormInputs = document.querySelectorAll("#login-form input");
    registerFormInputs.forEach(function (input) {
        input.addEventListener("keyup", handleRegisterInputChange);
        input.addEventListener("change", handleRegisterInputChange);
    });
    function handleRegisterInputChange(event) {
        var _a;
        var input = event.target;
        var id = input.dataset.id;
        var value = input.value;
        if (id in registerForm) {
            registerForm[id] = value;
        }
        var code = event instanceof KeyboardEvent ? (_a = event.which) !== null && _a !== void 0 ? _a : event.keyCode : 0;
        if (id === 'email' && code === 13) {
            registerButton === null || registerButton === void 0 ? void 0 : registerButton.click();
        }
    }
    loginFormInputs.forEach(function (input) {
        input.addEventListener("keyup", handleLoginInputChange);
        input.addEventListener("change", handleLoginInputChange);
    });
    function handleLoginInputChange(event) {
        var _a;
        var input = event.target;
        var id = input.dataset.id;
        var value = input.value;
        if (id in loginForm) {
            loginForm[id] = value;
        }
        var code = event instanceof KeyboardEvent ? (_a = event.which) !== null && _a !== void 0 ? _a : event.keyCode : 0;
        if (id === 'password' && code === 13) {
            loginButton === null || loginButton === void 0 ? void 0 : loginButton.click();
        }
    }
    var registerUser = function () { return __awaiter(_this, void 0, void 0, function () {
        var response, data, error_1;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    _a.trys.push([0, 5, , 6]);
                    return [4 /*yield*/, fetch('post_register', {
                            method: 'POST', // 設定請求方法
                            headers: {
                                'Content-Type': 'application/json', // 告訴伺服器我們正在發送 JSON
                            },
                            body: JSON.stringify(registerForm), // 將資料轉為 JSON 字串
                        })];
                case 1:
                    response = _a.sent();
                    if (!response.ok) return [3 /*break*/, 3];
                    return [4 /*yield*/, response.json()];
                case 2:
                    data = _a.sent();
                    console.log('註冊成功:', data);
                    return [3 /*break*/, 4];
                case 3:
                    console.error('註冊失敗:', response.statusText);
                    _a.label = 4;
                case 4: return [3 /*break*/, 6];
                case 5:
                    error_1 = _a.sent();
                    console.error('錯誤:', error_1);
                    return [3 /*break*/, 6];
                case 6: return [2 /*return*/];
            }
        });
    }); };
    registerButton === null || registerButton === void 0 ? void 0 : registerButton.addEventListener("click", function () {
        console.log(registerForm);
        registerUser();
    });
    var loginUser = function () { return __awaiter(_this, void 0, void 0, function () {
        var response, data, error_2;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    _a.trys.push([0, 5, , 6]);
                    return [4 /*yield*/, fetch('post_login', {
                            method: 'POST', // 設定請求方法
                            headers: {
                                'Content-Type': 'application/json', // 告訴伺服器我們正在發送 JSON
                            },
                            body: JSON.stringify(loginForm), // 將資料轉為 JSON 字串
                        })];
                case 1:
                    response = _a.sent();
                    if (!response.ok) return [3 /*break*/, 3];
                    return [4 /*yield*/, response.json()];
                case 2:
                    data = _a.sent();
                    console.log('登入成功:', data);
                    return [3 /*break*/, 4];
                case 3:
                    console.error('登入失敗:', response.statusText);
                    _a.label = 4;
                case 4: return [3 /*break*/, 6];
                case 5:
                    error_2 = _a.sent();
                    console.error('錯誤:', error_2);
                    return [3 /*break*/, 6];
                case 6: return [2 /*return*/];
            }
        });
    }); };
    loginButton === null || loginButton === void 0 ? void 0 : loginButton.addEventListener("click", function () {
        console.log(loginForm);
        loginUser();
    });
});
