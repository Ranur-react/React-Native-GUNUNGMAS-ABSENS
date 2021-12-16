/* @flow */

import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
  Dimensions,
  TextInput,
  Alert,
  TouchableOpacity,
  Svg,
  Keyboard,
  TouchableWithoutFeedback,
  ScrollView,
  Button, YellowBox, RefreshControl
} from 'react-native';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import Menuabsen from './Menu';
import HistoryAbsen from './History';



const { width: WIDTH } = Dimensions.get('window');
const { height: HEIGHT } = Dimensions.get('window');

let i = 0;
let bfore = 0; ''
const wait = (timeout) => {
  return new Promise(resolve => setTimeout(resolve, timeout));
}


const DESK = (props) => {
  if (props.actions) {
    return (
      <View >
        <Svgicon key={1} color="rgba(50,50,50,0.5)" name="Refresh-M" />
      </View>
    )
  } else {
    return (
      <View>
        <Deskripsiabsen />
      </View>
    )
  }

}
const HISTODESK = (props) => {
  if (props.actions) {
    return (
      <View >
        <Svgicon key={1} color="rgba(50,50,50,0.5)" name="Refresh-M" />
      </View>
    )
  } else {
    return (
      <HistoryAbsen key={9893} />
    )
  }

}

const Menu = (props) => {
  if (props.actions) {
    return (
      <View >
        <Svgicon key={1} color="rgba(255,255,255,0.5)" name="Refresh-M" />
      </View>
    )
  } else {
    return (
      <Menuabsen key={2} color="black" props={props.props} />

    )
  }
}
export default class Home extends Component {
  constructor(props) {
    super(props)
    this.state = {
      data: undefined,
      TpScroll: '',
      arrayytest: ['1', '2'],
      Jarak: '',
      Pjarak: '',
      tes: 300,
      refreshing: false,
      DESK: true,
    }
  }

  UNSAFE_componentWillMount() {
    // if (!this.state.refreshing) {
    //
    // }
    this.props.navigation.addListener('focus', () => {

      this.setState({ refreshing: true })
      wait(2000).then(() => this.setState({ refreshing: false }));
    });
  }
  onLayoutHEAD = event => {
    this.setState({ tinggiHEAD: event.nativeEvent.layout.height + 20 });

  }
  Refresh = () => {
    // const [refreshing, setRefreshing] = React.useState(false);
    console.log('Sedang Refresh-------');
    this.setState({ refreshing: true })
    wait(2000).then(() => this.setState({ refreshing: false }));
  }

  onRefresh = () => {
    // const [refreshing, setRefreshing] = React.useState(false);
    console.log('Selesai Refresh-------');
    this.setState({
      refreshing: false
    });
  }
  onScrollLayout = (e) => {
    let y = e.nativeEvent.contentOffset.y;
    let t = this.state.tinggiHEAD;
    let x = t / y;
    if (bfore <= x) {
      i = i - 0.04;
      this.setState({ TpScroll: 'rgba(255,255,255,' + i + ')' })
      console.log("Nilai Scrool: " + i);
      // if (i <= 0) {
      // }
    }
    else {
      i = i + 0.04;
      this.setState({ TpScroll: 'rgba(255,255,255,' + i + ')' })
    }
    bfore = x;
    if (y == 0) {
      i = 0;
      this.setState({ TpScroll: 'rgba(255,255,255,0)' })
    }
  }




  render() {
    console.disableYellowBox = true;
    YellowBox.ignoreWarnings(['Warning: isMounted(...) is deprecated', 'Module RCTImageLoader', 'RNDeviceInfo', 'Warning: An update']);



    return (
      <View style={styles.Backcontainer}>
        <View style={styles.container}>
          <View onLayout={this.onLayoutHEAD} style={styles.Textcontainer}>
            {
              <DESK key={891} actions={this.state.refreshing} />
            }

          </View>
        </View>
        <ScrollView refreshControl={
          <RefreshControl
            refreshing={this.state.refreshing}
            onRefresh={this.Refresh}
          />
        }
          style={[styles.ScrollFrontContainer, { backgroundColor: this.state.TpScroll }]}
          onScroll={this.onScrollLayout} >
          <View

          >

            <View style={[styles.Frontcontainer, { top: this.state.tinggiHEAD }]}>
              <View style={styles.container}>
                <Text style={styles.TextTitleWhite}>Ayo isi absennya!</Text>
                <View style={styles.menuContainer}>
                  {

                    <Menu key={8921} props={this.props} actions={this.state.refreshing} />
                  }
                </View>
              </View>
              <View style={styles.container}>
                <Text style={styles.TextTitleWhite}>History Absen</Text>
                <View style={styles.menuContainer}>


                  <View style={{ width: 400, height: 300 }}>
                    <HISTODESK actions={this.state.refreshing} />
                  </View>
                </View>
              </View>
            </View>
            <TouchableOpacity onPress={this.Refresh} style={styles.IconBox}>
              <Svgicon key={1} color="rgba(76,169,255,0.5)" name="Refresh-M" />
            </TouchableOpacity>
          </View>
        </ScrollView>
      </View>
    );
  }

}

const styles = StyleSheet.create({
  Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },
  container: {
    top: 20,
    width: WIDTH - 30,
    alignItems: 'flex-start',
    // // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer: {
    width: '100%',
    paddingBottom: 20
    // backgroundColor:'grey'
  },
  TextTitle: {
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color: 'rgba(0,0,0,1)'
  },
  TextTitleWhite: {
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color: 'rgba(255,255,255,1)'
  }
  , TextBody: {
    fontFamily: 'Raleway',
    fontSize: 15,
    lineHeight: 20,
    color: 'rgba(0,0,0,5)'
  },
  IconBox: {
    position: 'absolute',
    width: 50,
    height: 50,
    right: 0,
    margin: 20,


  },
  ScrollFrontContainer: {
    flex: 1,
    position: 'absolute',
    flexDirection: 'column',
    width: WIDTH,
    height: HEIGHT,
    // opacity:0.9
  },
  Frontcontainer: {
    flex: 1,
    backgroundColor: 'rgba(53,158,255,0.9)',

    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,

    elevation: 2,

    alignItems: 'center',
    width: WIDTH,
    height: 1346,
    borderTopLeftRadius: 40,
    borderTopRightRadius: 40,
    borderColor: 'rgba(0, 0, 0, 0.0)',
    borderTopWidth: 4
  },
  menuContainer: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    marginTop: 40,
    // backgroundColor:'yellow',
    width: '100%',
    justifyContent: 'center',
  },

});
