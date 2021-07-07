import Request from "@/libs/Request";

const auth = {
  login(data) {
    return new Request(data).post(
      "/api/auth/login"
    );
  },
}

export {
  auth,
};
