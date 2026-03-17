import { lazy } from 'react';
import { RouteObject } from 'react-router-dom';

const HomePage = lazy(() => import('../pages/home/page'));
const CategoryPage = lazy(() => import('../pages/category/page'));
const SubcategoryPage = lazy(() => import('../pages/subcategory/page'));
const AboutPage = lazy(() => import('../pages/about/page'));
const BlogPage = lazy(() => import('../pages/blog/page'));
const ContactPage = lazy(() => import('../pages/contact/page'));
const CasesPage = lazy(() => import('../pages/cases/page'));
const CookiesPage = lazy(() => import('../pages/cookies/page'));
const TermsPage = lazy(() => import('../pages/terms/page'));
const NotFound = lazy(() => import('../pages/NotFound'));

const routes: RouteObject[] = [
  {
    path: '/',
    element: <HomePage />,
  },
  {
    path: '/computer-vision',
    element: <CategoryPage />,
  },
  {
    path: '/computer-vision/security',
    element: <SubcategoryPage category="security" />,
  },
  {
    path: '/computer-vision/staff-performance',
    element: <SubcategoryPage category="staff-performance" />,
  },
  {
    path: '/computer-vision/object-recognition',
    element: <SubcategoryPage category="object-recognition" />,
  },
  {
    path: '/about',
    element: <AboutPage />,
  },
  {
    path: '/blog',
    element: <BlogPage />,
  },
  {
    path: '/contact',
    element: <ContactPage />,
  },
  {
    path: '/cases',
    element: <CasesPage />,
  },
  {
    path: '/cookies',
    element: <CookiesPage />,
  },
  {
    path: '/terms',
    element: <TermsPage />,
  },
  {
    path: '*',
    element: <NotFound />,
  },
];

export default routes;