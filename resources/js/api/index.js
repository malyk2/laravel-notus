import Request from "@/libs/Request";

const auth = {
  login(data) {
    return new Request(data).post("/api/admin/auth/login");
  },
  logout() {
    return new Request().post("/api/admin/auth/logout");
  },
  register(data) {
    return new Request(data).post("/api/admin/auth/register");
  },
  getMe() {
    return new Request().get("/api/admin/auth/me");
  },
  forgotPassword(data) {
    return new Request(data).post("/api/admin/auth/password/forgot");
  },
  resetPassword(data) {
    return new Request(data).post("/api/admin/auth/password/reset");
  },
  verifyEmail(id, hash, query) {
    return new Request().setParams(query).get("/api/admin/auth/verify/" + id + "/" + hash);
  },
}

export {
  auth,
};
