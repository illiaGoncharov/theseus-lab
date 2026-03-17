import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import Header from '../../components/feature/Header';
import Footer from '../../components/feature/Footer';

const ContactPage = () => {
  const [ref, inView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [formData, setFormData] = useState({
    name: '',
    company: '',
    email: '',
    description: '',
  });
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitStatus, setSubmitStatus] = useState<'idle' | 'success' | 'error'>('idle');

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);
    setSubmitStatus('idle');

    try {
      const formBody = new URLSearchParams();
      formBody.append('name', formData.name);
      formBody.append('company', formData.company);
      formBody.append('email', formData.email);
      formBody.append('description', formData.description);

      const response = await fetch('https://readdy.ai/api/form/d6n8mjtv117fnkj2he4g', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: formBody.toString(),
      });

      if (response.ok) {
        setSubmitStatus('success');
        setFormData({ name: '', company: '', email: '', description: '' });
      } else {
        setSubmitStatus('error');
      }
    } catch (error) {
      setSubmitStatus('error');
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="min-h-screen bg-dark-bg">
      <Header />
      
      <main className="pt-20">
        <section className="py-24 bg-gradient-to-br from-dark-bg via-dark-surface to-dark-bg">
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h1 className="text-5xl lg:text-6xl font-bold text-white mb-6">
                Свяжитесь с нами
              </h1>
              <p className="text-xl text-slate-400 max-w-3xl mx-auto">
                Расскажите о вашем проекте, и мы предложим оптимальное AI-решение
              </p>
            </motion.div>

            <div className="max-w-5xl mx-auto" ref={ref}>
              <div className="grid grid-cols-1 lg:grid-cols-5 gap-12">
                <motion.div
                  initial={{ opacity: 0, x: -50 }}
                  animate={inView ? { opacity: 1, x: 0 } : {}}
                  transition={{ duration: 0.6 }}
                  className="lg:col-span-3"
                >
                  <form 
                    id="contact_form" 
                    data-readdy-form 
                    onSubmit={handleSubmit}
                    className="space-y-6"
                  >
                    <div>
                      <label htmlFor="name" className="block text-sm font-medium text-slate-300 mb-2">
                        Имя *
                      </label>
                      <input
                        type="text"
                        id="name"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        required
                        className="w-full px-4 py-3.5 bg-dark-card border border-dark-border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-accent-cyan transition-colors"
                        placeholder="Ваше имя"
                      />
                    </div>

                    <div>
                      <label htmlFor="company" className="block text-sm font-medium text-slate-300 mb-2">
                        Компания *
                      </label>
                      <input
                        type="text"
                        id="company"
                        name="company"
                        value={formData.company}
                        onChange={handleChange}
                        required
                        className="w-full px-4 py-3.5 bg-dark-card border border-dark-border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-accent-cyan transition-colors"
                        placeholder="Название компании"
                      />
                    </div>

                    <div>
                      <label htmlFor="email" className="block text-sm font-medium text-slate-300 mb-2">
                        Email *
                      </label>
                      <input
                        type="email"
                        id="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        required
                        className="w-full px-4 py-3.5 bg-dark-card border border-dark-border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-accent-cyan transition-colors"
                        placeholder="your@email.com"
                      />
                    </div>

                    <div>
                      <label htmlFor="description" className="block text-sm font-medium text-slate-300 mb-2">
                        Описание проекта *
                      </label>
                      <textarea
                        id="description"
                        name="description"
                        value={formData.description}
                        onChange={handleChange}
                        required
                        maxLength={500}
                        rows={6}
                        className="w-full px-4 py-3.5 bg-dark-card border border-dark-border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-accent-cyan transition-colors resize-none"
                        placeholder="Расскажите о вашей задаче и требованиях к AI-решению"
                      />
                      <p className="text-xs text-slate-500 mt-2">
                        Максимум 500 символов
                      </p>
                    </div>

                    <button
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full px-8 py-4 bg-gradient-to-r from-accent-cyan to-accent-purple text-white text-lg font-semibold rounded-xl hover:shadow-2xl hover:shadow-accent-cyan/50 transition-all disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap cursor-pointer"
                    >
                      {isSubmitting ? 'Отправка...' : 'Отправить заявку'}
                    </button>

                    {submitStatus === 'success' && (
                      <div className="p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400 text-center">
                        Спасибо! Ваша заявка успешно отправлена. Мы свяжемся с вами в ближайшее время.
                      </div>
                    )}

                    {submitStatus === 'error' && (
                      <div className="p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-400 text-center">
                        Произошла ошибка при отправке. Пожалуйста, попробуйте позже.
                      </div>
                    )}
                  </form>
                </motion.div>

                <motion.div
                  initial={{ opacity: 0, x: 50 }}
                  animate={inView ? { opacity: 1, x: 0 } : {}}
                  transition={{ duration: 0.6 }}
                  className="lg:col-span-2 space-y-8"
                >
                  <div className="bg-gradient-to-br from-dark-card to-dark-surface border border-dark-border rounded-2xl p-6">
                    <h3 className="text-xl font-bold text-white mb-6">
                      Контактная информация
                    </h3>
                    
                    <div className="space-y-6">
                      <div className="flex items-start space-x-4">
                        <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center flex-shrink-0">
                          <i className="ri-mail-line text-xl text-accent-cyan w-6 h-6 flex items-center justify-center"></i>
                        </div>
                        <div>
                          <div className="text-sm text-slate-400 mb-1">Email</div>
                          <a href="mailto:info@aiengineering.ru" className="text-white hover:text-accent-cyan transition-colors cursor-pointer">
                            info@aiengineering.ru
                          </a>
                        </div>
                      </div>

                      <div className="flex items-start space-x-4">
                        <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center flex-shrink-0">
                          <i className="ri-telegram-line text-xl text-accent-cyan w-6 h-6 flex items-center justify-center"></i>
                        </div>
                        <div>
                          <div className="text-sm text-slate-400 mb-1">Telegram</div>
                          <a href="#" className="text-white hover:text-accent-cyan transition-colors cursor-pointer">
                            @aiengineering
                          </a>
                        </div>
                      </div>

                      <div className="flex items-start space-x-4">
                        <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center flex-shrink-0">
                          <i className="ri-whatsapp-line text-xl text-accent-cyan w-6 h-6 flex items-center justify-center"></i>
                        </div>
                        <div>
                          <div className="text-sm text-slate-400 mb-1">WhatsApp</div>
                          <a href="#" className="text-white hover:text-accent-cyan transition-colors cursor-pointer">
                            +7 (XXX) XXX-XX-XX
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="bg-gradient-to-br from-dark-card to-dark-surface border border-dark-border rounded-2xl p-6">
                    <h3 className="text-xl font-bold text-white mb-4">
                      Время ответа
                    </h3>
                    <p className="text-slate-400 leading-relaxed">
                      Мы отвечаем на все запросы в течение 24 часов в рабочие дни
                    </p>
                  </div>
                </motion.div>
              </div>
            </div>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
};

export default ContactPage;