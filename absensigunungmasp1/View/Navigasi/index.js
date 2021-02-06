// In App.js in a new project

import React, { Component } from 'react';
import { View, Text,Button } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import AsyncStorage from '@react-native-async-storage/async-storage';

//page-----------
import AfterCapture from './../AfterCapture';
import Capture from './../Capture';
import Pulang from './../Pulang/Capture';
import PulangAfterCapture from './../Pulang/AfterCapture';
import Home from './../Home';
import Login from './../Login';
import Sakit from './../Izinsakit';
///class

function HomeScreen({ navigation }) {
  return (
    <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
      <Text>Home Screen</Text>
      <Button
        title="Go to Details"
        onPress={() => navigation.navigate('Details')}
      />
    </View>
  );
}

function Details({ navigation }) {
  return (
    <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
      <Text>Details Screen</Text>
      <Button
        title="Go to ClassPage"
        onPress={() => navigation.navigate('ClassPage')}
      />
    </View>
  );
}

const Stack = createStackNavigator();

function App() {

  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Login">
      <Stack.Screen   options={{ headerShown:false, }}  name="HomeScreen" component={HomeScreen} />
      <Stack.Screen   options={{ headerShown:false, }}  name="AfterCapture" component={AfterCapture} />
      <Stack.Screen   options={{ headerShown:false, }}  name="Capture" component={Capture} />
      <Stack.Screen   options={{ headerShown:false, }}  name="Login" component={Login} />
      <Stack.Screen   options={{ headerShown:false, }}  name="Home" component={Home} />

      <Stack.Screen   options={{ headerShown:false, }}  name="Pulang" component={Pulang} />
      <Stack.Screen   options={{ headerShown:false, }}  name="PulangAfterCapture" component={PulangAfterCapture} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default App;