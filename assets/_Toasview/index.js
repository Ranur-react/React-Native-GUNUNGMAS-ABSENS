import React from 'react';
import { View, StyleSheet, ToastAndroid, Button, StatusBar} from 'react-native';


export const showToast = (e) => {
  ToastAndroid.show(e, ToastAndroid.SHORT);
};

export const showToastWithGravity = (e) => {
  ToastAndroid.showWithGravity(
    e,
    ToastAndroid.SHORT,
    ToastAndroid.CENTER
  );
};

export const showToastWithGravityAndOffset = (e) => {
  ToastAndroid.showWithGravityAndOffset(
    e,
    ToastAndroid.SHORT,
    ToastAndroid.BOTTOM,
    25,
    50
  );
};


