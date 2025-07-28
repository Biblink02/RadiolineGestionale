export interface InspireCardImage {
    src: string;
    alt: string;
}

export interface InspireCardData  {
    title: string;
    subtitle: string;
    button: string;
    onClick: () => void;
    images: InspireCardImage[];
}
