export interface InspireCardImage {
    src: string;
    alt: string;
}

export interface InspireCardData  {
    title: string;
    subtitle: string;
    onClick: () => void;
    images: InspireCardImage[];
}
