import Request from "@/libs/Request";

const auth = {
  login(data) {
    return new Request(data).post("/api/auth/login");
  },
  logout() {
    return new Request().post("/api/auth/logout");
  },
  register(data) {
    return new Request(data).post("/api/auth/register");
  },
  getMe() {
    return new Request().get("/api/auth/me");
  },
  forgotPassword(data) {
    return new Request(data).post("/api/auth/password/forgot");
  },
  resetPassword(data) {
    return new Request(data).post("/api/auth/password/reset");
  }
}

export {
  auth,
};
