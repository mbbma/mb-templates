export type IconPrefix = "fas" | "fab" | "far" | "fal" | "fad";
export type IconPathData = string | string[]

export interface IconLookup {
  prefix: IconPrefix;
  // IconName is defined in the code that will be generated at build time and bundled with this file.
  iconName: IconName;
}

export interface IconDefinition extends IconLookup {
  icon: [
    number, // width
    number, // height
    string[], // ligatures
    string, // unicode
    IconPathData // svgPathData
  ];
}

export interface IconPack {
  [key: string]: IconDefinition;
}

export type IconName = 'facebook-f' | 
  'facebook-square' | 
  'instagram' | 
  'linkedin' | 
  'linkedin-in' | 
  'pinterest' | 
  'twitter' | 
  'twitter-square' | 
  'long-arrow-down' | 
  'long-arrow-left' | 
  'long-arrow-right' | 
  'long-arrow-up' | 
  'angle-double-down' | 
  'angle-double-left' | 
  'angle-double-right' | 
  'angle-double-up' | 
  'angle-down' | 
  'angle-left' | 
  'angle-right' | 
  'angle-up' | 
  'arrow-down' | 
  'arrow-left' | 
  'arrow-right' | 
  'arrow-up' | 
  'angle-double-down' | 
  'angle-double-left' | 
  'angle-double-right' | 
  'angle-double-up' | 
  'angle-down' | 
  'angle-left' | 
  'angle-right' | 
  'angle-up' | 
  'arrow-down' | 
  'arrow-left' | 
  'arrow-right' | 
  'arrow-up' | 
  'caret-down' | 
  'caret-left' | 
  'caret-right' | 
  'caret-up' | 
  'check' | 
  'chevron-circle-down' | 
  'chevron-circle-left' | 
  'chevron-circle-right' | 
  'chevron-circle-up' | 
  'chevron-double-down' | 
  'chevron-double-left' | 
  'chevron-double-right' | 
  'chevron-double-up' | 
  'chevron-down' | 
  'chevron-left' | 
  'chevron-right' | 
  'chevron-up' | 
  'clock' | 
  'envelope' | 
  'map-marker-alt' | 
  'phone-alt' | 
  'search-plus' | 
  'star';
