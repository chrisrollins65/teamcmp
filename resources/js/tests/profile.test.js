import { shallowMount } from '@vue/test-utils';
import Profile from '../views/Profile.vue';
import axiosMock from "axios";
import Vue from 'vue';

describe('Profile.vue', () => {
    function mockIsFriendApiCall(value) {
        axiosMock.get.mockImplementationOnce(() => Promise.resolve({
            data: value
        }));
    }

    function mockProfileApiCall() {
        axiosMock.get.mockImplementationOnce(() => Promise.resolve({
            data: {
                'name': 'test',
                'age': 22,
                'location': 'New York',
                'description': 'desc',
                'avatar': 'sophie.jpg',
            }
        }));
    }

    test('Profile page loads correctly', async () => {
        mockIsFriendApiCall(false);
        mockProfileApiCall();
        const wrapper = shallowMount(Profile, {stubs: ['router-link']});
        await Vue.nextTick();
        expect(wrapper.find('button').text()).toContain('Add as friend');
    });

    test('Option to unfriend after adding as friend', async () => {
        mockIsFriendApiCall(false);
        mockProfileApiCall();
        const wrapper = shallowMount(Profile, {stubs: ['router-link']});
        await Vue.nextTick();
        wrapper.find('button').trigger('click');
        await Vue.nextTick();
        expect(wrapper.find('button').text()).toContain('Unfriend');
    });

    test('Friend removed when clicking "Unfriend"', async () => {
        mockIsFriendApiCall(true);
        mockProfileApiCall();
        const wrapper = shallowMount(Profile, {stubs: ['router-link']});
        await Vue.nextTick();
        const button = wrapper.find('button');
        expect(button.text()).toContain('Unfriend');
        button.trigger('click');
        await Vue.nextTick();
        expect(wrapper.find('button').text()).toContain('Add as friend');
    });
});
