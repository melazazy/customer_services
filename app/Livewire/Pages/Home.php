<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function mount()
    {
        // Initialize any data if needed
    }

    public function render()
    {
        return view('livewire.pages.home', [
            'services' => $this->getServices(),
            'stats' => $this->getStats(),
            'features' => $this->getFeatures(),
        ])->layout('layouts.app');
    }

    public function submitContact()
    {
        $this->validate();

        // Here you would typically send an email or save to database
        session()->flash('message', 'Thank you for your message. We\'ll get back to you soon!');

        $this->reset(['name', 'email', 'message']);
    }

    private function getServices()
    {
        return [
            [
                'icon' => 'fas fa-paint-brush',
                'title' => 'Web Design',
                'description' => 'Create stunning, responsive websites that capture your brand\'s essence.',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'delay' => 100
            ],
            [
                'icon' => 'fas fa-chart-line',
                'title' => 'Digital Marketing',
                'description' => 'Strategic digital marketing solutions to boost your online presence and drive growth.',
                'image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'delay' => 200
            ],
            [
                'icon' => 'fas fa-mobile-alt',
                'title' => 'App Development',
                'description' => 'Building innovative mobile applications that deliver exceptional user experiences.',
                'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'delay' => 300
            ],
            [
                'icon' => 'fas fa-pencil-ruler',
                'title' => 'UI/UX Design',
                'description' => 'Creating intuitive and engaging user interfaces with focus on user experience.',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'delay' => 400
            ],
            [
                'icon' => 'fas fa-search',
                'title' => 'SEO Optimization',
                'description' => 'Improving your website\'s visibility and ranking in search engine results.',
                'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'delay' => 500
            ]
        ];
    }

    private function getStats()
    {
        return [
            [
                'value' => '500+',
                'label' => 'Clients Served',
            ],
            [
                'value' => '1000+',
                'label' => 'Projects Completed',
            ],
            [
                'value' => '50+',
                'label' => 'Team Members',
            ],
            [
                'value' => '15+',
                'label' => 'Years Experience',
            ],
        ];
    }

    private function getFeatures()
    {
        return [
            [
                'icon' => 'fas fa-rocket',
                'title' => 'Fast Delivery',
                'description' => 'Quick turnaround times without compromising quality.',
            ],
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Secure Solutions',
                'description' => 'Built-in security measures to protect your digital assets.',
            ],
            [
                'icon' => 'fas fa-sync',
                'title' => 'Regular Updates',
                'description' => 'Continuous improvements and maintenance services.',
            ],
        ];
    }
}
