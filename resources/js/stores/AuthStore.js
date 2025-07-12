import { defineStore } from 'pinia';
import api from '../axios';
import { ref, computed } from 'vue';

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null);
  const authChecked = ref(false);

  const isAuthenticated = computed(() => !!user.value);

  async function fetchUser() {
    if (authChecked.value) return;

    try {
      console.log('Fetching user data...');
      const res = await api.get('/user/data');
      console.log("auth.store user ", res);
      
      // Extract the user data from the response
      user.value = res.data;
      authChecked.value = true;
    } catch (e) {
      console.log("Auth check failed:", e);
      user.value = null;
      authChecked.value = true;
    }
  }

  function setUser(userData) {
    console.log('Setting user in store:', userData);
    user.value = userData;
    authChecked.value = true;
  }

  function clearAuth() {
    console.log('Clearing auth...');
    user.value = null;
    authChecked.value = false; // Reset so we can check again
  }

  async function logout() {
    try {
      // Call the logout API endpoint
      await api.post('/logout');
    } catch (error) {
      console.error('Logout API error:', error);
    } finally {
      // Always clear the auth state, even if API call fails
      clearAuth();
    }
  }

  return {
    user,
    authChecked,
    isAuthenticated,
    fetchUser,
    setUser,
    clearAuth,
    logout
  };
});
