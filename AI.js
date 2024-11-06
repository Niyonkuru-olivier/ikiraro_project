// Import necessary libraries
const natural = require('natural');
const axios = require('axios');

// Set up the chatbot
class AgriBot {
  constructor() {
    this.tokenizer = new natural.WordTokenizer();
    this.stemmer = natural.PorterStemmer;
    this.language = 'english';
  }

  // Agricultural knowledge base
  knowledgeBase = {
    farming: {
      en: "Farming is the practice of cultivating plants and livestock for food, fiber, and other products.",
      es: "La agricultura es la práctica de cultivar plantas y ganado para obtener alimentos, fibras y otros productos."
    },
    irrigation: {
      en: "Irrigation is the application of controlled amounts of water to plants at needed intervals.",
      es: "El riego es la aplicación de cantidades controladas de agua a las plantas en intervalos necesarios."
    },
    fertilizer: {
      en: "Fertilizers are substances added to soil to improve plant growth and yield.",
      es: "Los fertilizantes son sustancias que se agregan al suelo para mejorar el crecimiento y el rendimiento de las plantas."
    },
    // Add more topics and their explanations in different languages
  };

  // Natural language processing
  processInput(input) {
    const tokens = this.tokenizer.tokenize(input.toLowerCase());
    return tokens.map(token => this.stemmer.stem(token));
  }

  // Multi-language support
  setLanguage(lang) {
    this.language = lang;
  }

  // Data integration (example: weather API)
  async getWeatherData(location) {
    try {
      const response = await axios.get(`https://api.weatherapi.com/v1/current.json?key=YOUR_API_KEY&q=${location}`);
      return response.data.current.condition.text;
    } catch (error) {
      console.error('Error fetching weather data:', error);
      return 'Unable to fetch weather data at the moment.';
    }
  }

  // Main chatbot function
  async generateResponse(input) {
    const processedInput = this.processInput(input);
    let response = '';

    // Check for weather-related queries
    if (processedInput.includes('weather')) {
      const location = processedInput.find(token => token !== 'weather');
      if (location) {
        const weatherData = await this.getWeatherData(location);
        return `The current weather in ${location} is: ${weatherData}`;
      }
    }

    // Check knowledge base for relevant information
    for (const [topic, content] of Object.entries(this.knowledgeBase)) {
      if (processedInput.includes(this.stemmer.stem(topic))) {
        response = content[this.language] || content.en; // Fallback to English if translation not available
        break;
      }
    }

    if (!response) {
      response = "I'm sorry, I don't have information on that specific topic. Can you please ask about farming, irrigation, fertilizers, or weather?";
    }

    return response;
  }
}

// Example usage
const agriBot = new AgriBot();

async function chat() {
  