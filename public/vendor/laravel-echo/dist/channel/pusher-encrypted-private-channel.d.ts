import { PusherChannel } from './pusher-channel';
/**
 * This class represents a Pusher private channel.
 */
export declare class PusherEncryptedPrivateChannel extends PusherChannel {
    /**
     * Send a whisper event to other clients in the channel.
     */
    whisper(eventName: string, data: any): PusherEncryptedPrivateChannel;
}
