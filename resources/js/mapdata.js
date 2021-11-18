var simplemaps_australiamap_mapdata={
  main_settings: {
   //General settings
    width: "responsive", //'700' or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    
    //State defaults
    state_description: "Have multiple links for each state.<br /><a  href=\"#\" onClick='alert(\"You would go to Link 1\")'>Link 1</a><br /><a  href=\"#\" onClick='alert(\"You would go to Link 2\")'>Link 2</a><br /><a  href=\"#\" onClick='alert(\"You would go to Link 3\")'>Link 3</a><br />",
    state_color: "#88A4BC",
    state_hover_color: "#3B729F",
    state_url: "http://simplemaps.com",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "yes",
    
    //Location defaults
    location_description: "Location description",
    location_color: "#FF0067",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_url: "",
    location_size: 25,
    location_type: "square",
    location_image_source: "frog.png",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
    //Label defaults
    label_color: "#d5ddec",
    label_hover_color: "#d5ddec",
    label_size: 22,
    label_font: "Arial",
    hide_labels: "no",
    hide_eastern_labels: "no",
   
    //Zoom settings
    zoom: "yes",
    back_image: "no",
    initial_back: "no",
    initial_zoom: "-1",
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
    zoom_time: 0.5,
    
    //Popup settings
    popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 1,
    popup_corners: 5,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    
    //Advanced settings
    div: "map",
    auto_load: "yes",
    url_new_tab: "no",
    images_directory: "default",
    fade_time: 0.1,
    link_text: "View Website",
    popups: "detect"
  },
  state_specific: {
    CT: {
      name: "Australian Capital Territory",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    JB: {
      name: "Jervis Bay Territory",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    NS: {
      name: "New South Wales",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    NT: {
      name: "Northern Territory",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    QL: {
      name: "Queensland",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    SA: {
      name: "South Australia",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    TS: {
      name: "Tasmania",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    VI: {
      name: "Victoria",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    WA: {
      name: "Western Australia",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    }
  },
  locations: {
    "0": {
      lat: -33.874,
      lng: 151.203,
      name: "Sydney"
    }
  },
  labels: {},
  legend: {
    entries: []
  },
  regions: {}
};