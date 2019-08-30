export const state = () => ({
});

export const mutations = {
};

export const getters = {
  user (state) {
    return state.auth.user;
  },
  loggedIn (state) {
    return state.auth.loggedIn;
  }
};

export const actions = {
  async nuxtServerInit({ commit, dispatch }) {
  }
};
