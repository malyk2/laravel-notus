import Request from "@/libs/Request";

const auth = {
  login(data) {
    return new Request(data).post("/api/auth/login");
  },
  getMe() {
    return new Request().get("/api/auth/me");
  },
}

export {
  auth,
};
