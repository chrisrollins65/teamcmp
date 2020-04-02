import { shallowMount } from '@vue/test-utils';
import Chat from '../views/Chat.vue';
import axiosMock from "axios";
import Vue from 'vue';

describe('Chat.vue', () => {
    function mockAvatarsApiCall() {
        axiosMock.get.mockImplementationOnce(() => Promise.resolve({
            data: [
                {
                    "id":"1",
                    "avatar":"sophie.jpg"
                },
                {
                    "id":"2",
                    "avatar":"bob.jpg"
                }
            ]
        }));
    }

    function mockChatApiCall() {
        axiosMock.get.mockImplementationOnce(() => Promise.resolve({
            data: [
                {
                    "message":"test message",
                    "sentBy":1
                }
            ]
        }));
    }

    test('Chat page loads correctly', async () => {
        mockAvatarsApiCall();
        mockChatApiCall();
        const wrapper = shallowMount(Chat, {stubs: ['router-link']});
        await Vue.nextTick();
        expect(wrapper.vm.chat).toStrictEqual([{
            "message":"test message",
            "sentBy":1
        }]);
    });

    test('Message sends correctly', async () => {
        mockAvatarsApiCall();
        mockChatApiCall();
        const wrapper = shallowMount(Chat, {stubs: ['router-link']});
        await Vue.nextTick();
        const textfield = wrapper.find('input');
        textfield.element.value = 'new message';
        textfield.trigger('input');
        wrapper.find('#message-box').trigger('keydown.enter');
        await Vue.nextTick();
        expect(wrapper.vm.chat).toStrictEqual([
            {
                "message":"test message",
                "sentBy":1
            },
            {
                "message":"new message",
                "sentBy":wrapper.vm.userId
            }
        ]);
    });

    test('Empty message not sent', async () => {
        mockAvatarsApiCall();
        mockChatApiCall();
        const wrapper = shallowMount(Chat, {stubs: ['router-link']});
        await Vue.nextTick();
        const textfield = wrapper.find('input');
        textfield.element.value = '';
        textfield.trigger('input');
        wrapper.find('#message-box').trigger('keydown.enter');
        await Vue.nextTick();
        expect(wrapper.vm.chat).toStrictEqual([
            {
                "message":"test message",
                "sentBy":1
            }
        ]);
    });
});
